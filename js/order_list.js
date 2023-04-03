function close_state() {
    document.getElementsByClassName("orderlist_info")[0].style.height = 0;
}
function open_state(dishes_info, order_info) {
    document.getElementsByClassName("orderlist_info")[0].style.height = "500px";
    let dish_price = [];
    let amount = [];
    let dish_name = [];
    for (let k in dishes_info) {
        dish_price.push(dishes_info[k]["dish_price"]);
        amount.push(dishes_info[k]["amount"]);
        dish_name.push(dishes_info[k]["dish_name"]);
    }

    /* 显示订单信息 */
    let orderlist_info = document.getElementsByClassName("orderlist_info_content")[0]; /* 获取订单信息的div */
    orderlist_info.innerHTML = "<p>订单号："+order_info['order_id']+"</p>" +
                    "<p>日期：" + order_info['time'] +
                    "</p><p>总金额：￥" + order_info['price'] +
                    "</p>";

    /* 显示订单状态 */
    let order_state = document.getElementsByClassName("orderlist_info_state")[0];
    if (order_info['payment_is_done'] == 0)  {
        order_state.innerHTML = "未支付";
    } else if (order_info['prepartion_is_done'] == 0) {
        order_state.innerHTML = "预计" + order_info['eta'] + "完成";
    } else if (order_info['prepartion_is_done'] == 1) {
        order_state.innerHTML = "订单已完成";
    }

    /* 显示店铺名称 */

    let window = document.getElementsByClassName("orderlist_window_name")[0];
    window.innerHTML = order_info['window_name'];

    /* 显示菜品 */
    display_order_detail(dish_price, amount, dish_name);

    /* 修改删除按钮的order_id */
    let del = document.getElementById("delete");
    del.setAttribute("onclick", "delete_order("+order_info['order_id']+")")

}
function display_order_detail(dish_price, amount, dish_name) {
    let old_div = document.getElementsByClassName("orderlist_info_dish")[0];
    let parent = document.getElementById("orderlist_block");    /* 父 */

    for (let i = 0 ; i < dish_price.length; i++) {
        let new_div = old_div.cloneNode(true);
        new_div.style.display = "block";

        /* 获取到数量 */
        new_div.getElementsByClassName("amount")[0].innerHTML = "购买数量：" + amount[i];

        /* 获取到价格 */
        new_div.getElementsByClassName("dish_price")[0].innerHTML = "￥" + dish_price[i];

        /* 获取到菜品名 */
        new_div.getElementsByClassName("dish_name")[0].innerHTML = dish_name[i];

        parent.appendChild(new_div);
    }

}

/* 删除订单 */
function delete_order (order_id) {
    if(!confirm('确认删除该订单？'))
        return;
    let str = "order_list.php?del=1&order_id=" + order_id;
    location.href=str;
}