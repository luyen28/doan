<style>
    .product_specifications {
    width: 100%;
    border-collapse: collapse;
}

.product_specifications th, .product_specifications td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.product_specifications th {
    background-color: #f2f2f2;
}

.product_specifications td {
    background-color: #ffffff;
}
</style>    
<div class="reviews content_text" style="float: left; width: 100%;">
    <h1 class="reviews-title"><b class="product_details_title">Thông Số Kỹ Thuật</b></h1>
    <div class="product_details_content">
        <table class="product_specifications">
            <tr>
                <th>Thuộc tính</th>
                <th>Thông số</th>
            </tr>
            <tr>
                <td><strong>CPU:</strong></td>
                <td>{!! $product->pro_cpu !!}</td>
            </tr>
            <tr>
                <td><strong>Ram:</strong></td>
                <td>{!! $product->pro_memory !!}</td>
            </tr>
            <tr>
                <td><strong>Bộ nhớ:</strong></td>
                <td>{!! $product->pro_storage !!}</td>
            </tr>
            <tr>
                <td><strong>Card đồ hoạ:</strong></td>
                <td>{!! $product->pro_graphic !!}</td>
            </tr>
            <tr>
                <td><strong>Màn hình:</strong></td>
                <td>{!! $product->pro_screen !!}</td>
            </tr>
            <tr>
                <td><strong>Kích thước:</strong></td>
                <td>{!! $product->pro_size !!}</td>
            </tr>
            <tr>
                <td><strong>Khối lượng:</strong></td>
                <td>{!! $product->pro_weight !!}</td>
            </tr>
        </table>
    </div>
</div>



