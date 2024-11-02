<option value="{{ $category->id }}">{{ $prefix }}{{ $category->name }}</option>
@if ($category->childrenCategories)
    @foreach ($category->childrenCategories as $childCategory)
        @include('admin.categories.categories-partial-order', [
            'category' => $childCategory,
            'prefix' => $prefix . '-- ',
        ])
    @endforeach
@endif
