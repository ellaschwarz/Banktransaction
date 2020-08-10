document.addEventListener('DOMContentLoaded', (e) => {

  //Getting username data from api to client
$.ajax({
  url: 'http://localhost:8888/api/read.php',
  contentType: 'application/json',
  dataType: 'text',
  success: function(data) {
    data = JSON.parse(data);
    console.log(data);
    
    //Looping the users from data.results and appends it to drop down menus for both the sender and recipient.
    for(i=0; i < data.result.length; i++) {
      let username = data.result[i].username;
      let to_account = data.result[i].account_id;
      let from_account = data.result[i].account_id;
      $("#to_account").append(`<option value="${to_account}">${username}</option>`);
      $("#from_account").append(`<option value="${from_account}">${username}</option>`);

    }
  }
});

});

document.getElementById('submit').addEventListener('click', function(e){
  e.preventDefault();
  getTransactionValues();

});

function getTransactionValues(){

  //Getting values from user input
  let from_account = document.getElementById('from_account').value;
  let to_account = document.getElementById('to_account').value;
  let to_amount = document.getElementById('to_amount').value;
  let from_amount = document.getElementById('from_amount').value;

//POST transaction data from client to api
$.ajax({
  type: 'post',
  url: 'http://localhost:8888/api/write.php',
  data: JSON.stringify({
    from_account: from_account, 
    to_account: to_account, 
    to_amount: to_amount, 
    from_amount: from_amount
  }),
  contentType: 'application/json',
  dataType: 'text',

  success: function(data) {
    console.log(data);
  },
  error: function(error)
  {
    console.log(error);
  }
});
}
