<div class="like">
    <button wire:click="toggleLike" class="like-button">
        <i class="{{ $liked ? 'fas fa-star' : 'far fa-star' }}"></i>
    </button>
    <span class="like-count">{{ $likeCount }}</span>

    <style>
    .like-button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 24px;
        color: {{ $liked ? '#ffbf00' : '#ffbf00' }};
    }
    </style>
</div>


