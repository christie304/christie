<?php

require 'vendor/guzzle/autoload.php'; // Replace with the path to your Guzzle installation

use GuzzleHtt;

// Set your OpenAI API key
$apiKey = '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';

// Create a Guzzle HTTP client
$client = new Client();

// Make a POST request to the API
$response = $client->post('https://api.openai.com/v1/engines/davinci-codex/completions', [
    'headers' => [
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ],
    'json' => [
        'prompt' => 'Hello, ChatGPT!',
        'max_tokens' => 50, // Adjust the desired response length
    ],
]);

// Get the API response
$data = json_decode($response->getBody(), true);
$reply = $data['choices'][0]['text'];

// Output the reply
echo $reply;


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input from the form
    $message = $_POST['message'];

    // Set your OpenAI API key
    $apiKey = 'YOUR_API_KEY';

    // Make a POST request to the ChatGPT API
    $response = getChatGPTResponse($message, $apiKey);

    // Get the reply from the API response
    $reply = $response['choices'][0]['text'];
}
function getChatGPTResponse($message, $apiKey) {
    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    $headers = [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
    ];
    $data = [
        'prompt' => $message,
        'max_tokens' => 50,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ChatGPT Demo</title>
</head>
<body>
    <h1>ChatGPT Demo</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="5" cols="30"></textarea><br>
        <input type="submit" value="Send">
    </form>

    <?php if (isset($reply)) { ?>
        <h2>ChatGPT Reply:</h2>
        <p><?php echo $reply; ?></p>
    <?php } ?>

</body>
</html>
