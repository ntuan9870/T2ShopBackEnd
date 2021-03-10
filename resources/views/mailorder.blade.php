

    <div id="wrap-inner">
        <div id="khach-hang">
            <h3>Thông tin khách hàng</h3>
            <p>
                <span class="info">Khách hàng: {{$user_name}}</span>
            </p>
            <p>
                <span class="info">Email: {{$user_email}}</span>
            </p>
            <p>
                <span class="info">Điện thoại: {{$user_phone}}</span>
            </p>
            <p>
                <span class="info">Địa chỉ: {{$user_address}}</span>
            </p>
            <p>
                <span class="info">Mã đơn hàng:{{$order_id}}</span>
            </p>
            <p>
                <span class="info">Tổng tiền đơn hàng:{{number_format($total,'0',',','.')}} VNĐ</span>
            </p>
        </div>
        <div id="hoa-don">
            <h3>Hóa đơn mua hàng</h3>
            <table class="table-bordered table-responsive">
                <tr class="bold">
                    <td width="30%">Tên sản phẩm</td>
                    <td width="25%">Giá</td>
                    <td width="10%">Bao Hanh</td>
                    <td width="10%"> KM</td>
                    <td width="10%"> SL</td>
                    <td width="15%">Thành tiền</td>
                </tr>
                @foreach($data  as $d)
                <tr>
                    <td>{{$d['product']['product_name']}}</td>
                    <td>{{number_format($d['product']['product_price'],'0',',','.')}} VNĐ</td>
                    <td>{{$d['product']['product_warranty']}}</td>
                    <td>{{$d['promotion']}} %</td>
                    <td>{{$d['num']}}</td>
                    <td>{{number_format(($d['num']*$d['product']['product_price']-($d['product']['product_price']*$d['promotion']/100)),'0',',','.')}} VNĐ</td>
                </tr>
                @endforeach

            </table>
        </div>
        <div id="xac-nhan">
            <br>
            <p>
                <b>Quý khách đã đặt hàng thành công!</b><br />
                • Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br />
                • Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng.<br />
                <b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</b>
            </p>
        </div>
    </div>

