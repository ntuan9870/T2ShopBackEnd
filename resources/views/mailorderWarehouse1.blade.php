<div id="wrap-inner">
    <div id="khach-hang">
        <h3>Thông tin cơ bản về đơn đặt hàng</h3>
        <p>
            <span class="info">Người lập phiếu: {{$user_name}}</span>
        </p>
        <p>
            <span class="info">Mã phiếu dặt hàng: {{$orderWh_id}}</span>
        </p>
        <p>
            <span class="info">Tổng tiền hàng: {{number_format($cost,'0',',','.')}} VNĐ</span>
        </p>
        <p>
            <span class="info">Tiền trả được: {{number_format($money,'0',',','.')}} VNĐ</span>
        </p>
        <p>
            <span class="info">Tiền cần nợ: {{number_format($debt,'0',',','.')}} VNĐ</span>
        </p>
        <p>
            <span class="info">Thời gian yêu cầu nhận hàng:{{$time}}</span>
        </p>
    </div>
    <div id="hoa-don">
        <h3>Chi tiết hàng cần đặt</h3>
        <table class="table-bordered table-responsive">
            <tr class="bold">
                <!-- <td width="15%">STT</td> -->
                <td width="10%">Mã hàng</td>
                <td width="20%">Tên hàng</td>
                <td width="10%">ĐVT</td>
                <td width="15%">Số lượng</td>
                <td width="15%">Đơn giá</td>
                <td width="15%">Thành tiền</td>
            </tr>
            @foreach($data  as $i => $item)
            <tr>
                <td>{{$i}}</td>
                <td>{{$item['prod_id']}}</td>
                <td>{{$item ['prod_name']}}</td>
                <td>{{$item ['unit']}}</td>
                <td>{{$amount[$i]}} %</td>
                <td>{{number_format($item['price'],'0',',','.')}} VNĐ</td>
                <td>{{number_format( $product_price[$i],'0',',','.')}} VNĐ</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="xac-nhan">
        <br>
        <p>
            <b>Vui lòng phản hồi sớm nhất có thể vào đường link này http://localhost:4200/supplier/confirm/{{$orderWh_id}} cảm ơn!</b>
        </p>
    </div>
</div>

