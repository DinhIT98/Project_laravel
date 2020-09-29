<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Di động Việt</title>
	<!-- BOOTSTRAP CSS -->
	<link href="{{ URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- AWESOME ICON FONT -->
	<link href="{{URL::asset('lib/awesome/css/font-awesome.min.css')}}" rel="stylesheet">

	<!-- IMPORT FONT GOOGLE LINK -->
	<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,700,300&amp;subset=vietnamese,latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link href="{{ URL::asset('css/style.css')}}" rel="stylesheet">
    <!-- SLIDE CSS -->
    <link rel="stylesheet" href="{{URL::asset('lib/slider/default.css')}}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{URL::asset('lib/slider/nivo-slider.css')}}" type="text/css" media="screen" />
    <!-- Owl Carousel Assets -->
    <link href="{{URL::asset('lib/owlcarousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{URL::asset('lib/owlcarousel/owl.theme.css')}}" rel="stylesheet">

</head>
<body>
	@include('Layout/header')
    @yield('content')
    @include('Layout/footer')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript">
		$(".discart").hover(function(){
			$(".top-cart-content").css("display","block");
		}, function(){
			$(".top-cart-content").css("display","none");
		});
	</script>
	<script src="{{URL::asset('lib/slider/jquery.nivo.slider.pack.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		$(window).load(function() {
		    $('#slider').nivoSlider();
		});
	</script>

	<!-- Owl Carousel Assets -->
	<script src="{{URL::asset('lib/owlcarousel/owl.carousel.js')}}"></script>
	<script>
    $(document).ready(function() {
      	$("#slider-tintuc").owlCarousel({
      		autoPlay: 3000,
	      	navigation : true,
	      	slideSpeed : 300,
	      	paginationSpeed : 400,
	      	singleItem : true
      	});
      	$("#spmoi").owlCarousel({
      		autoPlay: 3000,
      		// items : 4,
	       //  itemsDesktop : [1199,3],
	       //  itemsDesktopSmall : [979,3],
	       //  itemsMobile : [768,2]
	       	itemsCustom : [
		        [0, 2],
		        [600, 3],
		        [1200, 4],
		    ],
      	});
	});
    </script>

    <script type="text/javascript">
    	// hidden-show children menu
		$(document).ready(function () {
		    //use event delegation since classes are changed dynamically
		    $('.ulspmobi').on('click', '.iconlist', function () {
		        //remove the show class and assign hidden
		        $(this).toggleClass('iconlist1 iconlist');
		        //the subfield is a child of the parent not the next sibling
		        $(this).siblings('ul.mnboxl_1').show('slow');
		    });
		    $('.ulspmobi').on('click', '.iconlist1', function () {
		        $(this).toggleClass('iconlist1 iconlist');
		        $(this).siblings('ul.mnboxl_1').hide('slow');
		    });
		});
    </script>
     <script type="text/javascript">
     	$(document).ready(function () {
   $("input[type=number]").bind('keyup input', function(){
        // alert($("#price").text());
        var id=$(this).attr('id');
        var id_price='price'+id;
        var id_total_price='total_price'+id;
        var quantity=$(this).val();
        var price=$("#"+id_price).val();
        var total_price=price*quantity;
        document.getElementById(id_total_price).innerHTML=total_price;
        var arr_price=$(".price").text();
        var total=0;
        Array.from($(".price")).forEach(function(item){
                 total+=parseInt(item.textContent);
        });

        // for(var i=0;i<arr_price.length();i++){
        //     total+=parseInt(arr_price[i]);
        // }
        // // alert(total);
        document.getElementById("total").innerHTML=total;

        // alert(total_price);
        // alert("xxxxxxx " +id_price);
        // var data=$("#price").val();
        // var number=parseInt(data);
        // alert(number);
    });
         });

    </script>
</body>
</html>
