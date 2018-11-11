<link rel="stylesheet" href="{{asset('css/reset.css')}}" />
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/public.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('/css/media/public-media.css')}}" type="text/css">

<link rel="stylesheet" href="{{asset('lib/common.css')}}">
<script src="{{asset('lib/common.js')}}"></script>
<script type="text/javascript">
  let common = new Common();
  common.token = '{{csrf_token()}}';  //获取token;
  </script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.cookie.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('lib/layer/2.4/layer.js')}}"></script>
<script src="{{asset('js/vue.min.js')}}"></script>
<script src="{{asset('js/public.js')}}"></script>