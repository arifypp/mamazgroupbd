@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','ইনভাইট পাঠান')
@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('body')
{{-- Profile section  --}}
<section class="profile-section">
   <div class="container">
      <div class="row">
          <div class="col-md-6 offset-md-3 m-auto my-5 py-5">
              <div class="card">
                  <div class="card-header">
                      <i class="fas fa-copy"></i> রেফারেল ইউজার লিঙ্ক কপি করুন।
                  </div>
                  <div class="card-body py-5 text-center">
                      <input type="text" name="" id="" class="form-control referllink" value="{{ route('homepage') }}/register?ref={{ $refereluser->username }}" readonly><br>
                      <a href="{{ route('user.dashboard') }}" class="btn btn-danger">ড্যাশবোর্ড ব্যাক করুন</a>
                      <button class="btn btn-primary"> <i class="fas fa-copy"></i> লিঙ্ক কপি করুন</button>
                  </div>
              </div>
          </div>
      </div>
   </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
$('button.btn-primary').click(function(){
    $(this).siblings('input.referllink').select();      
    document.execCommand("copy");
    $(".btn-primary").text("লিঙ্ক কপি হয়েছে");
    var msg = 'রেফারেল লিঙ্ক কপি সম্পূর্ণ হয়েছে।'; 
    toastr.success(msg); 
    toastr.options = { onclick: function () { alert(msg); } }

});

</script>
@endsection