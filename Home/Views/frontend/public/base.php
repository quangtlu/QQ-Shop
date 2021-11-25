<?php $this->view("frontend.public.web.css.bootstrap") ?>
<?php $this->view("frontend.public.web.css.animate") ?>
<?php $this->view("frontend.public.web.css.flexslider") ?>
<?php $this->view("frontend.public.web.css.jqueryui") ?>
<?php $this->view("frontend.public.web.css.style") ?>
<!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Boostrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- cart -->
<script src="./Home/Views/frontend/public/web/js/simpleCart.min.js"></script>
<!-- cart -->
<!-- for bootstrap working -->
<script type="text/javascript" src="./Home/Views/frontend/public/web/js/bootstrap-3.1.1.min.js"></script>
<!-- //for bootstrap working -->
<link
    href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
    rel='stylesheet' type='text/css'>
<link
    href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic'
    rel='stylesheet' type='text/css'>
<!-- //timer -->
<!-- animation-effect -->
<script src="./Home/Views/frontend/public/web/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //animation-effect -->

<!-- alert -->
<style>
    #success-alert{
		font-size: 14px;
		z-index: 99;
		width: fit-content;
		right: 20px;
		position: absolute;
		animation: fadeInDown 0.5s linear;
		box-shadow: rgba(0, 0, 0, 0.56) 0px 10px 70px 2px;
	}
	
	#gallery_01 img {

	border: 2px solid white;

	}

	.active img {

	border: 2px solid #333 !important;

	}
	.gallery-wrap{
		display: flex;
		flex-wrap: wrap;
	}
	.current-price{
		color: #d8703f ;
		font-size: 20px;
	}
	.old-price{
		text-decoration: line-through;
	}
	.discount{
		margin-left: 10px;
		background-color: #d8703f;
		color:#fff;
		padding: 3px 10px;
		border-radius: 4px;
	}
	.discount span{
		font-size: 14px;
	}
	.item_add:hover{
		background-color: #d8703f;
		color:#fff !important;

	}
	.cart-icon{
		font-size: 30px;
		position: relative;
	}
	.cart-number{
		font-size: 10px;
		position: absolute;
		right: -20px;
		top: -10px;
		border-radius: 2.75rem;
		background-color: #d8703f;
		color: #fff;
		padding: 5px;
	}
	.short-text{
	overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 2; /* number of lines to show */
   -webkit-box-orient: vertical;

	}
	.title-td{
		width: 500px;
	}
	.list-group-item{
		font-size: 16px;
		font-weight: 400;
	}
	.modal-layout{
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 999999;
		background-color: rgba(0,0,0,0.25);
		display: none;

	}
	.modal-form-info{
		position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding-box;
        background-clip: padding-box;
	}
	.closeBtn{
		font-size: 25px;
		color:red;
		cursor: pointer;
		position: absolute;
		right: 30px;
		top:20px;
		z-index: 1;
	}
	.list-option{
		display: flex;
		flex-direction: column;
		background-color: #fff;
		position: absolute;
		padding: 5px;
		width: 100%;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
		z-index: 99;
		display: none;
		border-radius: 4px;

	}
	.list-option-link{
		font-size: 14px;
		display: block;
		padding: 2px 0;
	}
	.user-item:hover .list-option{
		display: block;
	}
	.detailBtn{
		font-size: 16px;
		color: blue;
		cursor: pointer;
	}
	.exitBtn{
		font-size: 25px;
		color:red;
		cursor: pointer;
		position: absolute;
		right: -19px;
    	top: -20px;
		z-index: 1;
	}
	.product-detail__description{
		max-height: 500px;
		overflow-y: scroll;
		border: 1px solid #ccc;
	}
	
</style>
