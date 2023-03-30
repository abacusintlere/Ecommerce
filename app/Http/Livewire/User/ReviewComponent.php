<?php

namespace App\Http\Livewire\User;

use App\Models\OrderItem;
use App\Models\Review;
use Livewire\Component;

class ReviewComponent extends Component
{
    public $order_item_id, $rating, $comment;

    // Mount Hook
    public function mount($order_item_id)
    {
        $this->order_item_id = $order_item_id;
    }

    public function render()
    {
        $order_item = OrderItem::find($this->order_item_id);
        return view('livewire.user.review-component', compact('order_item'))->layout('layouts.base');
    }

    // Updated Hook
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'rating' => 'required',
            'comment' => 'required'
        ]);
    }

    // Add A Review
    public function addReview()
    {
        $this->validate([
            'rating' => 'required',
            'comment' => 'required'
        ]);

        $review = new Review();
        $review->rating =$this->rating;
        $review->comment = $this->comment;
        $review->order_item_id = $this->$this->order_item_id;
        $review->save();
        // Updating Order Item Rstatus
        $item = OrderItem::find($this->order_item_id);
        $item->rstatus = true;
        $item->update();
        session()->flash('review_message', 'You Review Has Been Added Successfully!');
    }
}
