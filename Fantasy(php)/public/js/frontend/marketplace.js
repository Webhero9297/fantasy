$(document).ready(function(){
    $('.celebrity-card').click();
    loadLatestTweet();
});
function loadLatestTweet(){
    var _url = 'https://stream.twitter.com/1.1/statuses/sample.json';
    $.getJSON(_url,function(data){
        //data is holding a JSON object
        console.log('twitter', data);
    });
}