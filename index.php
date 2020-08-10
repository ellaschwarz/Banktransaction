
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/styles/styles.css">
    <title>Bank</title>
</head>
<body>
<div class="form">
<ul class="tab-group">


<div class="tab-content">
<form action="" method="post">

  <div class="container">
  <h1>Transfer money</h1>
  <h5>Sign in</h5>
  <select id="from_account" name="from_account" required>
    <option value="">Select a sender:</option>
  </select>
  </ul>
  <h1>To whom do you want to make a transaction?</h1>

    <select name="to_account" id="to_account">
    <option value="">Select a recipient:</option>
  </select>

    <input type="number" class="field-wrap" id="to_amount" placeholder="Type the amount to be sent" 
    name="to_amount" required>

    <input type="number" class="field-wrap" id="from_amount" placeholder="Repeat amount to be sent" 
    name="from_amount" required>

    <button type="submit" class="button button-block" id="submit">Send</button>

  </div>
</form>
</div>
</div>
    <script src="ajax.js"></script>
</body>
</html>