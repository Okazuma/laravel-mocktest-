<div class="multi__select">
    <input class="detail-input" type="text" name="category_id" id="category_id" value="{{ implode(', ', array_map(fn($id) => $options[$id], $selectedOptions)) }}" wire:click="toggleCategoryList" readonly>
    @error('category_id')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

    @if($showCategoryList)
        <div class="category-list">
            <ul>
                @foreach($options as $id => $category)
                    <li>
                        <input type="checkbox" wire:click="toggleSelection('{{ $id }}')"
                                @if(in_array($id, $selectedOptions)) checked @endif>
                        {{ $category }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
        @foreach($selectedOptions as $id)
            <input type="hidden" name="category_id[]" value="{{ $id }}">
        @endforeach
    <div>
        <ul>
            @foreach($selectedOptions as $id)
                <span>
                    {{ $options[$id] }}
                    <button type="button" wire:click="removeSelection('{{ $id }}')">x</button>
                </span>
            @endforeach
        </ul>
    </div>
</div>