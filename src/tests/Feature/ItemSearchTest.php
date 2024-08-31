<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;

use App\Http\Livewire\ItemSearch;


class ItemSearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // 検索フォームに入力で検索処理が行われているか確認するテストーーーーーーーーーー
    public function test_search_term_updates_and_emits_event()
    {
        Livewire::test(ItemSearch::class)
            ->set('searchTerm', 'Test')
            ->assertEmitted('searchUpdated', 'Test');
    }
}
