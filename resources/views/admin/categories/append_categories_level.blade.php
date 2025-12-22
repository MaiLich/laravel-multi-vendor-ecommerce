{{-- NOTE: FILE NÀY ĐƯỢC INCLUDE TRONG add_edit_category.blade.php (trong <div id="appendCategoriesLevel">) --}}
{{-- Hiển thị danh sách <select> <option> danh mục phụ thuộc vào Nhóm danh mục đã chọn, sử dụng AJAX --}}
{{-- File riêng biệt để CategoryController@appendCategoryLevel có thể trả về toàn bộ nội dung qua AJAX (xem admin/js/custom.js) --}}

<div class="form-group">
    <label for="parent_id">Chọn cấp danh mục cha</label>
    <select name="parent_id" id="parent_id" class="form-control">
        <option value="0" {{ isset($category['parent_id']) && $category['parent_id'] == 0 ? 'selected' : '' }}>
            Danh mục chính (cấp 0)
        </option>

        @if (!empty($getCategories))
            @foreach ($getCategories as $parentCategory)
                <option value="{{ $parentCategory['id'] }}"
                        {{ isset($category['parent_id']) && $category['parent_id'] == $parentCategory['id'] ? 'selected' : '' }}>
                    {{ $parentCategory['category_name'] }}
                </option>

                {{-- Hiển thị danh mục con (subcategory) --}}
                @if (!empty($parentCategory['subCategories']))
                    @foreach ($parentCategory['subCategories'] as $subcategory)
                        <option value="{{ $subcategory['id'] }}"
                                {{ isset($category['parent_id']) && $category['parent_id'] == $subcategory['id'] ? 'selected' : '' }}>
                            &nbsp;&nbsp;└─ {{ $subcategory['category_name'] }}
                        </option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
    <small class="text-muted">Chọn “Danh mục chính” nếu đây là danh mục cấp cao nhất.</small>
</div>