$(document).ready(function () {
    $("#my-loader").css('display','none');
    loadCart();
    loadWish();
});
function qnt_incre(){
    $(".qtyBtn").on("click", function() {
      var qtyField = $(this).parent(".qtyField"),
         oldValue = $(qtyField).find(".qty").val(),
          newVal = 1;

      if ($(this).is(".plus")) {
        newVal = parseInt(oldValue) + 1;
      } else if (oldValue > 1) {
        newVal = parseInt(oldValue) - 1;
      }
      $(qtyField).find(".qty").val(newVal);
    });
}

function loadCart(){
    $("#my-loader").css('display','block');
    $.ajax({
        type: "GET",
        url: "/cartCount",
        success: function (response) {
            $("#my-loader").css('display','none');
            $('.countcart').html(response.count);
        }
    });
}

function loadWish(){
    $("#my-loader").css('display','block');
    $.ajax({
        type: "GET",
        url: "/wishCount",
        success: function (response) {
            $("#my-loader").css('display','none');
            $('.wishcount').html(response.count);
        }
    });
}

function createData(cartdata){
    const base_path = window.location.origin;
    var cartHtml = "";
    $.each(cartdata, function (ele, item) {
        cartHtml += `<li class="item">
                                <a class="product-image" href="#">
                                    <img src="${base_path}/storage/images/products/${item.image}" alt="3/4 Sleeve Kimono Dress">
                                </a>
                                <div class="product-details">
                                    <a href="javascript:void(0)" class="remove cart__remove" data-id="${item.id}"><i class="anm anm-times-l" aria-hidden="true"></i></a>
                                    <a class="pName" href="cart.html">${item.name}</a>
                                    <div class="variant-cart">Black / XL</div>
                                    <div class="wrapQtyBtn">
                                        <div class="qtyField">
                                            <a class="qtyBtn minuss" href="javascript:void(0);" data-id="${item.id}" data-qty="${item.qty}"><i class="icon icon-minus"></i></a>
                                            <input class="cart__qty-input qty" type="text" name="updates[]" id="qty" data-id="${item.id}" value="${item.qty}" pattern="[0-9]*">
                                            <a class="qtyBtn pluss" href="javascript:void(0);" data-id="${item.id}" data-qty="${item.qty}"><i class="icon icon-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="priceRow">
                                        <div class="product-price">
                                            <span class="money">$${(item.qty * item.price).toFixed(2)}</span>
                                        </div>
                                     </div>
                                </div>
                            </li>`;
    });
    $('#header-cart .mycart').html(cartHtml);
    qnt_incre();
    minus();
    plus();
    cardataremove();
}

