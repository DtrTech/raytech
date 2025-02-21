<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use App\Models\RemoveTintSetting;
use App\Models\Sale;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function calculateCommission(Sale $sale){
        
        $tintRemoveSetting = RemoveTintSetting::find(1);
        $user_ids = [
            $sale->fws_worker_id, $sale->rws_worker_id, $sale->r1_worker_id,
            $sale->r2_worker_id, $sale->l1_worker_id, $sale->l2_worker_id,
            $sale->r3_worker_id, $sale->l3_worker_id, $sale->srf_worker_id, $sale->srf2_worker_id, $sale->srfbig_worker_id
        ];
        $user_ids = array_filter(array_unique($user_ids), function($id) {
            return !empty($id);
        });
        
        $worker = [];
        foreach ($user_ids as $user) {
            $worker[$user] = [
                'total' => 0,
                'total_remove_commission' => 0
            ];
        }
    
        $all_total = 0;
        $all_total_remove_commission = 0;
    
        $roles = ['fws', 'rws', 'r1', 'r2', 'l1', 'l2', 'r3', 'l3', 'srf','srf2','srfbig'];
        
        foreach ($roles as $role) {
            $worker_id = $sale->{$role . '_worker_id'};
            $product_id = $sale->{$role . '_product_id'};
            $remove_worker_id = $sale->{$role . '_remove_worker_id'};
    
            if ($worker_id > 0) {
                $product = Product::find($product_id);
                $commission = $product->{$role} ?? 0;
    
                $all_total += $commission;
                $worker[$worker_id]['total'] += $commission;
                $worker[$worker_id]['full_total'] += $commission;
            }
    
            if ($remove_worker_id > 0) {
                $remove_commission = $tintRemoveSetting->{$role} ?? 0;
                $all_total_remove_commission += $remove_commission;
                $worker[$remove_worker_id]['total_remove_commission'] += $remove_commission;
                $worker[$worker_id]['full_total'] += $remove_commission;
            }
        }
    
        return [
            'worker' => $worker,
            'all_total' => $all_total,
            'all_total_remove_commission' => $all_total_remove_commission,
        ];
    }
}
