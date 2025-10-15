<style>
.headingsCS {
    text-decoration-line: underline;
    color: <?php echo $headerButton ?>;
}

.header ul.nav-links li.list-inline-item a.active {
    color: <?php echo $headerButton ?>;
}

.selectpicker.dropdown-toggle {
    background-color: #fff !important;
    border: 1px solid #cccccc47;
    color: <?php echo $headerButton ?>;
    /*font-family: 'Tajawal';*/
}

.join-btn {
    background-color: <?php echo $headerButton ?>;
    color: #fff;
    padding: 0.4rem 1.2rem;
    border-radius: 6px;
    /*font-family: 'Tajawal';*/
}

#menu li a.active {
    color: <?php echo $headerButton ?>;
}

.search-box span.cat {
    padding: 8px 15px;
    background-color: #fafafa;
    color: <?php echo $headerButton ?>;
    border-radius: 6px;
    margin: 0px 6px;
    font-size: 14px;
   /*font-family: 'Tajawal';*/
}

.search-btn {
    padding: 0.7rem ;
    background: <?php echo $headerButton ?>;
    color: #fff;
    border-radius: 0px;
   /*font-family: 'Tajawal';*/
}

.owl-nav button {
    position: absolute;
    top: 25%;
    height: 40px;
    width: 40px;
    border-radius: 50%;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    background-color: #fff !important;
    color: <?php echo $headerButton ?> !important;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px;
    cursor: pointer;
}

.category-sidebar .card-link h6 {
    color: <?php echo $headerButton ?>;
    /*font-family: 'Tajawal';*/
    display: flex;
    align-items: center;
    font-size: 15px;
    margin-bottom: 0px;
}

.category-sidebar .card-body a:hover p {
    color: <?php echo $headerButton ?>;
}

.category-sidebar .card-body a:hover p:before {
    background-color: <?php echo $headerButton ?>;
}

.productPriceWrapper .discountedPrice {
    font-size: 15px;
    font-weight: 400;
    color: <?php echo $headerButton ?>;
    font-style: italic;
    position: absolute;
    top: -20px;
    left: -4px;
    padding: 0px 5px;
    overflow: hidden;
}

.productPriceWrapper .discountedPrice:before {
    content: "";
    width: 100%;
    height: 1px;
    display: inline-block;
    background-color: <?php echo $headerButton ?>;
    position: absolute;
    top: 50%;
    left: 0px;
}

.cart-btn {
    height: 36px;
    padding-left: 17px;
    padding-right: 17px;
    font-size: 13px;
    font-weight: 700;
    border-width: 2px;
    border-style: solid;
    border-color: rgb(247, 247, 247);
    border-image: initial;
    border-radius: 18px;
    cursor: pointer;
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    width: auto;
    padding-top: 0px;
    padding-bottom: 0px;
    box-sizing: border-box;
    color: <?php echo $headerButton ?>;
    background-color: transparent;
    /*font-family: 'Tajawal';*/
}

.cart-btn:hover {
    color: rgb(255, 255, 255);
    background-color: <?php echo $headerButton ?>;
    border-color: <?php echo $headerButton ?>;
}

.load-btn {
    min-width: 135px;
    background-color: #ffffff;
    border: 1px solid #f1f1f1;
    color: <?php echo $headerButton ?>;
    font-size: 14px;
    /*font-family: 'Tajawal';*/
}

.category-sidebar .selected {
    background: <?php echo $headerButton ?>;
    padding: 12px 2rem;
    font-size: 15px;
    /*font-family: 'Tajawal';*/
    border-top: 1px solid #ccc6;
}

.product-cart {
    background: <?php echo $headerButton ?>;
}

.cart_price {
    width: auto;
    height: 35px;
    min-width: 80px;
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    background-color: rgb(255, 255, 255);
    /*font-family: 'Tajawal';*/
    font-size: 13px;
    font-weight: 700;
    color: <?php echo $headerButton ?>;
    overflow: hidden;
    border-radius: 6px;
    margin: 0px 10px 10px;
}

.Counterstyle {
    display: flex;
    background-color: <?php echo $headerButton ?>;
    color: rgb(255, 255, 255);
    font-size: 15px;
    font-weight: 700;
    -webkit-box-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    align-items: center;
    flex-shrink: 0;
    width: 104px;
    height: 36px;
    border-radius: 200px;
    overflow: hidden;
}

#sync2 .current .item {
    border: 2px solid <?php echo $headerButton ?>;
}

.modal-padding .ProductPrice {
    /*font-family: 'Tajawal';*/
    font-size: 18px;
    color: <?php echo $headerButton ?>;
    margin: 2px 5px;
    border: 1px solid #dee2e6;
    padding: 6px;
    padding-left: 10px;
    padding-right: 10px;
}

.CartItem {
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    color: <?php echo $headerButton ?>;
}

.PromoCode button {
    box-shadow: none;
    background-color: transparent;
    display: inline-flex;
    /*font-family: 'Tajawal';*/
    cursor: pointer;
    font-size: 15px;
    color: <?php echo $headerButton ?>;
    border-width: 0px;
    outline: 0px;
    transition: color 0.35s ease 0s;
}

.CheckoutButton {
    height: 48px;
    width: calc(100% - 30px);
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    justify-content: space-between;
    background: <?php echo $headerButton ?>;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px;
    cursor: pointer;
    margin-bottom: 15px;
    margin-left: 15px;
    margin-right: 15px;
    padding: 0px;
    border-radius: 48px;
    border-width: 0px;
    outline: 0px;
}

.PriceBox {
    width: auto;
    height: 35px;
    min-width: 80px;
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    background-color: rgb(255, 255, 255);
    /*font-family: 'Tajawal';*/
    font-size: 13px;
    font-weight: 700;
    color: <?php echo $headerButton ?>;
    overflow: hidden;
    border-radius: 20px 20px 20px 20px;
    margin: 10px 6px 10px;
}

.Information .Price {
    color: <?php echo $headerButton ?>;
    margin-top: 10px;
    margin-bottom: 10px;
}

.form-popup .title {
    color: <?php echo $headerButton ?>;
    margin-bottom: 10px;
    font-family: Poppins-Bold;
    font-size: 21px;
    font-weight: 700;
}

.form-popup a.link {
    color: <?php echo $headerButton ?>;
    /*font-family: 'Tajawal';*/
    text-decoration: underline;
}

.forgot-link p {
    font-size: 15px;
    font-weight: 400;
    color: <?php echo $headerButton ?>;
    margin: 0px;
}

.sidebar-menu a.active {
    color: <?php echo $headerButton ?>;
    padding-right: 45px;
    border-right: 5px solid <?php echo $headerButton ?>;
    border-left: none;
}

.left-to-right .sidebar-menu a.active {
    padding-left: 45px;
    border-left: 5px solid <?php echo $headerButton ?>;
    border-right: none;
}

.home-btn:hover {
    background-color: <?php echo $headerButton ?>;
    color: rgb(255, 255, 255);
    border-color: <?php echo $headerButton ?>;
}

.form-control:focus {
    border-color: <?php echo $headerButton ?>;
}

.checkout-informationbox input.form-control {
    background-color: transparent;
    border: none;
    border-bottom: 1px solid <?php echo $headerButton ?>;
    border-radius: 0px;
    padding: 0px;
}

.checkout-informationbox select.form-control {
    background-color: transparent;
    border-color: <?php echo $headerButton ?>;
}

select + i.fa {
    margin-top: -40px;
    pointer-events: none;
    background-color: #fff;
    font-size: 24px;
    color: <?php echo $headerButton ?>;
    font-weight: 700;
    float: left;
    margin-left: 2px;
    padding-left: 15px;
}

.left-to-right select + i.fa {
    float: right;
    margin-right: 2px;
    padding-right: 15px;
}

.checkout-informationbox .nav-tabs li a.active {
    background-color: <?php echo $headerButton ?>;
}

.checkout-heading-box .count-number {
    font-size: 16px;
    font-weight: 400;
    color: rgb(255, 255, 255);
    width: 40px;
    height: 40px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    background-color: <?php echo $headerButton ?>;
    margin-left: 15px;
    margin-right: 0px;
    border-radius: 50%;
}

.left-to-right .checkout-heading-box .count-number {
    margin-right: 15px;
    margin-left: 0px;
}

.radiocardwrapper:hover {
    background-color: rgb(255, 255, 255);
    border-width: 1px;
    border-style: solid;
    border-color: <?php echo $headerButton ?>;
    border-image: initial;
}

.payment-box .radiocardwrapper:hover {
    background-color: rgb(255, 255, 255);
    border-width: 1px;
    border-style: solid;
    border-color: <?php echo $headerButton ?>;
    border-image: initial;
}

.radiocardwrapper.active {
    background-color: rgb(255, 255, 255);
    border-width: 1px;
    border-style: solid;
    border-color: <?php echo $headerButton ?>;
    border-image: initial;
}

.singleorderlist.active {
    border: 2px solid <?php echo $headerButton ?>;
}

.singleorderlist:hover {
    border: 2px solid <?php echo $headerButton ?>;
}

.order-itemdetails .order-item-price {
    font-size: 13px;
    color: <?php echo $headerButton ?>;
    margin-bottom: 0px;
}

.order-tracking .is-complete {
    display: block;
    position: relative;
    border-radius: 50%;
    height: 35px;
    width: 35px;
    border: 0px solid #ffffff;
    background-color: #ffffff;
    border: 1px dashed <?php echo $headerButton ?>;
    margin: 0 auto;
    transition: background 0.25s linear;
    -webkit-transition: background 0.25s linear;
    z-index: 2;
}

.order-tracking .is-complete:after {
    content: counter(my-awesome-counters);
    display: block;
    position: absolute;
    height: 14px;
    width: 7px;
    top: -3px;
    bottom: 0;
    left: 12px;
    margin: auto 0;
    border: 0px solid #afafaf;
    border-width: 0;
    text-align: center;
    opacity: 1;
    font-size: 13px;
    color: <?php echo $headerButton ?>;
    /*font-family: 'Tajawal';*/
}

.order-tracking.completed .is-complete {
    border-color: <?php echo $headerButton ?>;
    border-width: 0px;
    background-color: <?php echo $headerButton ?>;
}

.order-tracking.completed:before {
    background-color: <?php echo $headerButton ?>;
}

.social-icons li a {
    font-size: 20px;
    border-radius: 50%;
    color: #ffffff;
    border: 1px solid #cccccc;
    background-color: <?php echo $headerButton ?>;
    height: 45px;
    width: 45px;
    display: inline-flex;
    text-align: center;
    justify-content: center;
    align-items: center;
}

.social-icons li a:hover {
    border: 1px solid #77798c1c;
    background-color: <?php echo $headerButton ?>;
    color: #fff;
}

.cat-slider .item.active p {
    color: <?php echo $headerButton ?>;
    background-color: rgb(248, 248, 248);
}

.product-box1 .cart-btn:hover {
    color: #fff !important;
    background-color: <?php echo $headerButton ?>;
    border-color: <?php echo $headerButton ?>;
}

.pm-btn-cust:hover {
    background-color: <?php echo $headerButton ?>;
    color: #fff !important; 
}

.btn-theme-cust {
    background: <?php echo $headerButton ?>;
    color: #fff;
    text-align: center;
    border-radius: 0px;
    width: 100%;
    height: 40px;
}

.theme-btn {
    background: <?php echo $headerButton ?>;
    color: #fff;
    height: 48px;
    padding: 0px 30px;
    border-radius: 6px;
    /*font-family: 'Tajawal';*/
}

/* Styles for the loading screen */
.loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid <?php echo $headerButton ?>; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

