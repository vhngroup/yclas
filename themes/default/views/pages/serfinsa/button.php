<button id="safinsa-pay" type="submit" class="btn btn-info pay-btn full-w" action="<?=Route::url('default', ['controller' => 'serfinsa', 'action' => 'pay', 'id' => $order->id_order])?>">
    <span class="glyphicon glyphicon-shopping-cart"></span> <?=_e('Pay Now')?>
</button>

<script>
    var popup;

    window.addEventListener("load", function(){
        $('#safinsa-pay').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                cache: false,
                url: $(this).attr('action'),
                success: function(data) {
                    if(data && data.status == 1){
                        safinsaPopupWindow(data.path, "", "600", "850");
                    }
                }
            });
        });
    });

    function safinsaPopupWindow(url, title, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        popup = window.open(url, title, 'toolbar=no, location=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no,width='+w+',height='+h+',top='+top+',left='+left+'');
        return popup;
    }
</script>
