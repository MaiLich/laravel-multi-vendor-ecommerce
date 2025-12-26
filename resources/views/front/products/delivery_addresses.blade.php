{{-- This page is 'include'-ed in front/products/checkout.blade.php, and will be used by jQuery AJAX to reload it, check front/js/custom.js --}}


    <!-- Form-Fields /- -->
    <h4 class="section-h4 deliveryText">Thêm địa chỉ giao hàng mới</h4> {{-- We created that deliveryText CSS class to use the HTML element as a handle for jQuery to change the <h4> content when clicking the Edit button --}}
    <div class="u-s-m-b-24">
        <input type="checkbox" class="check-box" id="ship-to-different-address" data-toggle="collapse" data-target="#showdifferent">

        @if (count($deliveryAddresses) > 0)
            <label class="label-text newAddress" for="ship-to-different-address">Giao hàng đến địa chỉ khác?</label>
        @else
            <label class="label-text newAddress" for="ship-to-different-address">Đánh dấu để thêm địa chỉ giao hàng</label>
        @endif

    </div>
    <div class="collapse" id="showdifferent">
        <!-- Form-Fields -->

        <form id="addressAddEditForm" action="javascript:;" method="post">
            @csrf

            <input type="hidden" name="delivery_id">

            <div class="group-inline u-s-m-b-13">
                <div class="group-1 u-s-p-r-16">
                    <label for="delivery_name">Họ và tên
                        <span class="astk">*</span>
                    </label>
                    <input class="text-field" type="text" id="delivery_name" name="delivery_name" placeholder="Nhập họ và tên">
                    <p id="delivery-delivery_name"></p>
                </div>
                <div class="group-2">
                    <label for="delivery_address">Địa chỉ
                        <span class="astk">*</span>
                    </label>
                    <input class="text-field" type="text" id="delivery_address" name="delivery_address" placeholder="Nhập địa chỉ chi tiết">
                    <p id="delivery-delivery_address"></p>
                </div>
            </div>
            <div class="group-inline u-s-m-b-13">
                <div class="group-1 u-s-p-r-16">
                    <label for="delivery_city">Thành phố
                        <span class="astk">*</span>
                    </label>
                    <input class="text-field" type="text" id="delivery_city" name="delivery_city" placeholder="Nhập thành phố">
                    <p id="delivery-delivery_city"></p>
                </div>
                <div class="group-2">
                    <label for="delivery_state">Tỉnh / Bang
                        <span class="astk">*</span>
                    </label>
                    <input class="text-field" type="text" id="delivery_state" name="delivery_state" placeholder="Nhập tỉnh / bang">
                    <p id="delivery-delivery_state"></p>
                </div>
            </div>
            <div class="u-s-m-b-13">
                <label for="select-country-extra">Quốc gia
                    <span class="astk">*</span>
                </label>
                <div class="select-box-wrapper">
                    <select class="select-box" id="delivery_country" name="delivery_country">
                        <option value="">Chọn quốc gia</option>

                        @foreach ($countries as $country)
                            <option value="{{ $country['country_name'] }}"  @if ($country['country_name'] == \Illuminate\Support\Facades\Auth::user()->country) selected @endif>{{ $country['country_name'] }}</option>
                        @endforeach

                    </select>
                    <p id="delivery-delivery_country"></p>
                </div>
            </div>
            <div class="u-s-m-b-13">
                <label for="delivery_pincode">Mã bưu điện
                    <span class="astk">*</span>
                </label>
                <input class="text-field" type="text" id="delivery_pincode" name="delivery_pincode" placeholder="Nhập mã bưu điện">
                <p id="delivery-delivery_pincode"></p>
            </div>
            <div class="u-s-m-b-13">
                <label for="delivery_mobile">Số điện thoại
                    <span class="astk">*</span>
                </label>
                <input class="text-field" type="text" id="delivery_mobile" name="delivery_mobile" placeholder="Nhập số điện thoại">
                <p id="delivery-delivery_mobile"></p>
            </div>
            <div class="u-s-m-b-13">
                <button style="width: 100%" type="submit" class="button button-outline-secondary">Lưu địa chỉ</button>
            </div>

        </form>

        <!-- Form-Fields /- -->

    </div>
    <div>
        <label for="order-notes">Ghi chú đơn hàng</label>
        <textarea class="text-area" id="order-notes" placeholder="Ghi chú về đơn hàng của bạn, ví dụ: lưu ý đặc biệt cho giao hàng..."></textarea>
    </div>