<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Shop;
use App\Models\Like;
use App\Models\Reserve;
use App\Models\Review;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/')->assertStatus(200);
    }
    
    public function test_search()
    {
        $response = $this->post('/search')->assertStatus(200);
    }
    
    public function test_detail()
    {
        $item = Shop::factory()->create();
        $response = $this->get('/detail/'.$item->id);
        $response->assertStatus(200);
    }

    public function test_like()
    {
        $shop = Shop::factory()->create();
        $user = User::factory()->create();
        $data =[
            'user_id' => '1',
            'shop_id' => '1',
            'status' =>'1'
        ];

        $response = $this->actingAs($user)
            ->post('/like/'.$shop->id-=1 , $data);
        $response->assertStatus(302);
    }

    public function test_dislike()
    {
        $shop = Shop::factory()->create();
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)
            ->post('/dis_like/'.$shop->id-=1);
        $response->assertStatus(302);
    }

    public function test_reserve()
    {
        
        $data = [
        'user_id' =>'1',
        'shop_id'=> '1',
        'number' => '5',
        'date_time'=>'2022/12/10 12:00',
        ];
        
        $response = $this->post('/reserve', $data);
        $response->assertStatus(302);
    }
    
    public function test_review()
    {
        
        $data = [
            'user_id' =>'1',
            'shop_id'=> '1',
            'date_time'=>'2022/12/10 12:00',
            'grade'=> '5',
            'comment'=> 'comment',
        ];
        
        $response = $this->post('/review', $data);
        $response->assertStatus(302);
    }
    
    public function test_update()
    {
        $item = Reserve::factory()->create();
        $data = [
        'user_id' =>'1',
        'shop_id'=> '1',
        'number' => '5',
        'date_time'=>'2022/12/10 12:00',
        ];
        $response = $this->post('/update/' . $item->id, $data);
        $response->assertStatus(302);
    }
    
    public function test_delete()
    {
        $item = Reserve::factory()->create();
        $response = $this->post('/delete/' . $item->id);
        $response->assertStatus(302);
    }
}
