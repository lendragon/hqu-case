/* 单个菜品加数量 */
function add(amount_class, btn_id_0, btn_id_1, price, div_id, dish_id) {
    let p = document.getElementsByClassName(amount_class);
    let sub_btn = document.getElementsByClassName(btn_id_0);
    let add_btn = document.getElementsByClassName(btn_id_1);
    for (let i = 0; i < p.length; i++) {
        let amount = p[i].innerText;

        if (amount >= 0 && amount < 99) {
            sub_btn[i].style.background = "darkblue";
            amount++;
            p[i].innerHTML = amount;
        }
        if (amount === 99) {
            add_btn[i].style.background = "grey";
        }
    }

    price_change(price, 1); /* 购物车加钱 */

    /*购物车中物品发生变化*/
    cart_items_change(div_id, dish_id);
}

/* 单个菜品减数量 */
function subtract(amount_class,btn_id_0, btn_id_1, price, div_id, dish_id) {
    let p = document.getElementsByClassName(amount_class);  /* 单个菜品元素 */
    let sub_btn = document.getElementsByClassName(btn_id_0);    /* 减号元素 */
    let add_btn = document.getElementsByClassName(btn_id_1);

    for (let i = 0; i < p.length; i++) {
        let amount = p[i].innerText;   /* 单个菜品数量 */

        if (amount <= 0) return; /* 禁止数量小于0 */

        amount--;

        if (amount === 0) {
            sub_btn[i].style.background = "grey";
        }
        if (amount === 98) {

            add_btn[i].style.background = "darkblue";
        }
        p[i].innerHTML = amount;   /* 修改单个菜品数量； - 1 */
    }


    price_change(price, 0); /* 购物车减钱 */

    /*购物车中物品发生变化*/
    cart_items_change(div_id, dish_id);

}

/* 购物车价格发生变化 */
function price_change (price, change) {
    let cart_price_ele = document.getElementsByClassName('cart_price'); /* 总价格元素 */
    let cart_price = cart_price_ele[0].innerText;  /* 总价格 */

    let result_price = parseInt(cart_price.substr( 1));

    if (change === 0) { /* 为0为减 */
        result_price -= price;    /* 总价格减去菜品价格 */
        if (result_price === 0) {   /* 如果总价格为0，去掉小红标 */
            let point = document.getElementById("cart_item").children[0];
            point.style.height = "0";
            point.style.width = "0";
        }
    } else {    /* 其他为加 */
        result_price += price;    /* 总价格加上菜品价格 */
        /* 加上小红标 */
        let point = document.getElementById("cart_item").children[0];
        point.style.height = "15px";
        point.style.width = "15px";
    }

    cart_price_ele[0].innerHTML = "￥" + result_price;
    cart_price_ele[1].innerHTML = "￥" + result_price;

    cart_anime ();  /* 购物车图标发生变化 */

}

/* 购物车的动态效果 */
function cart_anime () {
    /* 大小发生变化 */
    let cart = document.getElementById("cart_item").children[1].childNodes[0];    /* 获取购物车 */
    cart.style.fontSize = "70px";   /* 变大 */
    /* 等待1s */
    setTimeout(() => {
        cart.style.fontSize = "60px";
    }, 150); /* 变回去 */

}


let dishes = {};    /* 购物车中的菜品 */
/* 购物车中的物品发生变化 */
function cart_items_change(div_id, dish_id) {
    let cart_detail = document.getElementById("cart_detail");  /* 获取购物车中的物品标签 */
    let old_div = document.getElementById(div_id);  /* 要复制的div */
    let children = cart_detail.childNodes;

    for (let i = 0; i < children.length; i++) { /* 如果已经存在该菜品则退出 */
        if (children[i].id === div_id) {
            /* 存在该id */
            let child_1 = children[i].childNodes;
            /* 遍历直到找到数量 */
            for (let j = 0; j < child_1.length; j++) {
                if (child_1[j].className === "info") {
                    let child_2 = child_1[j].childNodes;
                    for (let k = 0; k < child_2.length; k++) {
                        if (child_2[k].className === "count") {
                            let id_node = child_2[k].childNodes[3];
                            dishes[dish_id] = id_node.innerText;
                            if (id_node.innerText === "0") {
                                cart_detail.removeChild(children[i]);
                                delete dishes[dish_id];
                                return;
                            }
                            break;
                        }
                    }
                    break;
                }
            }
            return;
        }
    }
    let new_dish = old_div.cloneNode(true); /* 克隆的div */
    new_dish.setAttribute("class", "dishes_in_cart");   /* 更改新生成的div的class属性 */
    cart_detail.appendChild(new_dish);  /* 添加div至购物车中 */
    dishes[dish_id] = "1";
    console.log(dishes);

}

/* 展示购物车详情 */
let flag = false;   /* 购物车详情未打开 */
function display_cart_detail() {
    let cart_detail = document.getElementById("cart_detail");  /* 获取购物车中的物品标签 */
    if (flag) { /* 详情已打开 */
        cart_detail.style.width = "0";
    } else {
        cart_detail.style.width = "45%";
    }
    flag = !flag;
}


/* 关掉二维码 */
function quit(window_id) {

}

/* 结算 */
function settlement_fun() {
    let q = document.getElementById("QRcode_block");
    let out = document.getElementById("outter");
    q.style.width = "450px";
    q.style.height = "600px";
    out.style.display = "block";
}

/* 获取dishes对象 */
function get_dishes() {
    return dishes;
}