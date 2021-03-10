<form action="{{url('status')}}" method="post">
    <input type="text"  name="orderWh_id" placeholder="Vui lòng nhập mã phiếu nhập hàng" > 
    <input type="radio" checked value="1" name="status" >Chấp nhận cấp hàng
    <input type="radio"  value="2" name="status"> Không cấp hàng
    {{csrf_field()}}
    <button class="btn btn-default action"  type="submit">Thực hiện</button>
</form>