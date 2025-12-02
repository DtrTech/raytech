<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use App\Models\User;
use App\Models\RemoveTintSetting;
use App\Models\Sale;
use App\Models\ItemSale;
use App\Models\ItemSaleDt;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function calculateCommission(Sale $sale){
    
        $tintRemoveSetting = RemoveTintSetting::find(1);
        $worker = [];
        
        $all_total = 0;
        $all_total_remove_commission = 0;
        $all_total_coating_commission = 0;

        // Collect all product IDs first
        $roles = ['fws', 'rws', 'r1', 'r2', 'l1', 'l2', 'r3', 'l3', 'srf','srf2','srfbig'];
        $product_ids = [];
        
        foreach ($roles as $role) {
            $product_id = $sale->{$role . '_product_id'};
            if ($product_id > 0) {
                $product_ids[] = $product_id;
            }
        }
        
        // Fetch all products in ONE query
        $products = Product::withTrashed()->whereIn('id', array_unique($product_ids))->get()->keyBy('id');
        
        foreach ($roles as $role) {
            $worker_id = $sale->{$role . '_worker_id'};
            $product_id = $sale->{$role . '_product_id'};
            $remove_worker_id = $sale->{$role . '_remove_worker_id'};

            if ($worker_id > 0) {
                // Initialize worker only when needed
                if (!isset($worker[$worker_id])) {
                    $worker[$worker_id] = [
                        'total' => 0,
                        'total_remove_commission' => 0,
                        'total_coating_commission' => 0,
                        'full_total' => 0
                    ];
                }
                
                // Get product from pre-loaded collection
                $product = $products->get($product_id);
                $commission = $product ? ($product->{$role} ?? 0) : 0;

                $all_total += $commission;
                $worker[$worker_id]['total'] += $commission;
                $worker[$worker_id]['full_total'] += $commission;
            }

            if ($remove_worker_id > 0) {
                if (!isset($worker[$remove_worker_id])) {
                    $worker[$remove_worker_id] = [
                        'total' => 0,
                        'total_remove_commission' => 0,
                        'total_coating_commission' => 0,
                        'full_total' => 0
                    ];
                }
                
                $remove_commission = $tintRemoveSetting->{$role} ?? 0;
                $all_total_remove_commission += $remove_commission;
                $worker[$remove_worker_id]['total_remove_commission'] += $remove_commission;
                $worker[$remove_worker_id]['full_total'] += $remove_commission;
            }
        }

        // Handle coating worker commission
        if (!empty($sale->coating_worker_id) && $sale->coating_worker_id > 0) {
            $coating_worker_id = $sale->coating_worker_id;
            
            if (!isset($worker[$coating_worker_id])) {
                $worker[$coating_worker_id] = [
                    'total' => 0,
                    'total_remove_commission' => 0,
                    'total_coating_commission' => 0,
                    'full_total' => 0
                ];
            }
            
            $coating_commission = 0.5;
            $all_total_coating_commission += $coating_commission;
            $worker[$coating_worker_id]['total_coating_commission'] += $coating_commission;
            $worker[$coating_worker_id]['full_total'] += $coating_commission;
        }

        return [
            'worker' => $worker,
            'all_total' => $all_total,
            'all_total_remove_commission' => $all_total_remove_commission,
            'all_total_coating_commission' => $all_total_coating_commission,
        ];
    }

    public function checkSales(ItemSale $item_sale){
        $user_ids = User::pluck('id')->toArray();
        $worker = [];
        foreach ($user_ids as $user) {
            $worker[$user] = [
                'total_sales_commission' => 0,
                'total_work_commission' => 0,
                'total_commission' => 0
            ];
        }

        // Load relationships excluding soft-deleted records (if relationships use soft deletes)
        foreach($item_sale->workers as $work){
            // Skip if work record is somehow invalid
            if (!$work || !isset($work->worker_id)) {
                continue;
            }
            
            // Initialize worker if not exists (for deleted users)
            if (!isset($worker[$work->worker_id])) {
                $worker[$work->worker_id] = [
                    'total_sales_commission' => 0,
                    'total_work_commission' => 0,
                    'total_commission' => 0
                ];
            }
            
            $worker[$work->worker_id]['total_work_commission'] += $work->worker_commission ?? 0;
            $worker[$work->worker_id]['total_commission'] += $work->worker_commission ?? 0;
        }
        
        foreach($item_sale->salePersons as $sale){
            // Skip if sale record is somehow invalid
            if (!$sale || !isset($sale->worker_id)) {
                continue;
            }
            
            // Initialize worker if not exists (for deleted users)
            if (!isset($worker[$sale->worker_id])) {
                $worker[$sale->worker_id] = [
                    'total_sales_commission' => 0,
                    'total_work_commission' => 0,
                    'total_commission' => 0
                ];
            }
            
            $worker[$sale->worker_id]['total_sales_commission'] += $sale->worker_commission ?? 0;
            $worker[$sale->worker_id]['total_commission'] += $sale->worker_commission ?? 0;
        }
    
        return [
            'worker' => $worker,
        ];
    }
}