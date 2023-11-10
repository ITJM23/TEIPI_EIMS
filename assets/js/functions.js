userInfo()

fetchKulay()

function formatDate(date_val){

    var formattedDate = new Date(date_val);
    var d = formattedDate.getDate();
    var m = formattedDate.getMonth();
    // m += 1;  // JavaScript months are 0-11
    var y = formattedDate.getFullYear();

    const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
    ];

    if(d < 10){

        d = "0" + d
    }

    m = monthNames[m]

    return m +" "+ d + ", " +y
}



function empDD(id){

    $.ajax({
        type: "POST",
        url: "exec/fetch.php",
        data: {
            action:"emp_dd"
        },
        dataType: "JSON",
        success: function (response) {
            
            $('#'+id).html(response)
        }
    })
}



function userInfo(){

    $.ajax({
        type: "POST",
        url: "exec/fetch.php",
        data: {
            action:"user_info"
        },
        dataType: "JSON",
        success: function (response) {

            var pc_ipaddr = $('#pc_ipaddr').val()

            var fullname = response.Fname +" "+ response.Lname
            
            $('#usr_name').html(fullname)
            $('.emp_fname').html(response.Fname)
            $('#usr_position').html(response.EmpPos)

            // if(response.EmpImg == null || response.EmpImg == ''){

            //     $('.usr_img').attr('src', '../assets/images/profile_img/User2.png')
            // }

            // else{
                
            //     $('.usr_img').attr('src', 'http://'+pc_ipaddr+':8080/TEIPI_IMS/assets/images/users/'+response.EmpImg)
            // }
        }
    })
}



function bgKulay(color_id){

    $.ajax({
        type: "POST",
        url: "exec/fetch.php",
        data: {
            colorid:color_id,
            action:"change_bg"
        },
        dataType: "JSON",
        success: function (response) {
            
            console.log('color changed')
        }
    })
}



function fetchKulay(){

    $.ajax({
        type: "POST",
        url: "exec/fetch.php",
        data: {
            action:"get_bg_cookie"
        },
        dataType: "JSON",
        success: function (response) {
            
            $('.bg-theme').attr('class', 'bg-theme bg-'+response)

            // alert(response)
        }
    })
}



function catDD(id){

    $.ajax({
        type: "POST",
        url: "exec/fetch.php",
        data: {
            action:"cat_dd"
        },
        dataType: "JSON",
        success: function (response) {
            
            $('#'+id).html(response)
        }
    })
}



function itemsDD(id){

    $.ajax({
        type: "POST",
        url: "exec/fetch.php",
        data: {
            action:"item_dd"
        },
        dataType: "JSON",
        success: function (response) {
            
            $('#'+id).html(response)
        }
    })
}

// toastr.options = {
//     "closeButton": false,
//     "debug": false,
//     "newestOnTop": false,
//     "progressBar": false,
//     "positionClass": "toast-top-right",
//     "preventDuplicates": false,
//     "onclick": null,
//     "showDuration": "300",
//     "hideDuration": "1000",
//     "timeOut": "5000",
//     "extendedTimeOut": "1000",
//     "showEasing": "swing",
//     "hideEasing": "linear",
//     "showMethod": "fadeIn",
//     "hideMethod": "fadeOut"
// }