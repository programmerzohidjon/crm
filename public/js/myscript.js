$('#myProfileForm').on('profile_submit',function(event){
  event.preventDefault();
  name = $('#name').val();
  email = $('#email').val();
  address = $("#address").val();
  birthday = $("#birthday").val();
  file = $("#file").val();
  uid = $("#uid").val();
  phone = $("#phone").val();
  password = $("#password").val();
  $.ajax({
    url: "{{route('myprofile_edit')}}",
    type:"POST",
    data:{
      "_token": "{{ csrf_token() }}",
      name:name,
      email:email,
      address:address,
      birthday:birthday,
      file:file,
      uid:uid,
      phone:phone,
      password:password,
    },
    success:function(response){
      alert("message");
    },
  });
});