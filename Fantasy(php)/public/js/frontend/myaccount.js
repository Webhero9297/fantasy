$(document).ready(function(){
    $.get('/accountinfo', function(userInfo){
        $('#label_balance').html('loading...');
        AthleteUtility.getBalance(userInfo.wallet_id, function(balance){
            $('#label_balance').html(balance+"ETH");
        });
    });
});