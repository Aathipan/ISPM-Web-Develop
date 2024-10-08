<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Security Quiz</title>
    <link rel="stylesheet" href="res/css/em_security_quiz.css">
    <link rel="stylesheet" href="res/css/styles.css">
    
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
    <script> 
    $(function(){
      $("#header").load("header.html"); 
      $("#footer").load("footer.html"); 
    });
    </script>

</head>
<body>
    <div id="header"></div>

    <header>
        <h1>Email Security Quiz</h1>
    </header>
    <main>
        <section class="quiz-section">
            <h2 style="color:black;">Test Your Knowledge</h2>
    
            <ul id="quiz-options">
                <li>
                    <p>Which of the following is an email security best practice?</p>
                    <button onclick="checkAnswer('correct', 'q1', this)">Enable two-factor authentication</button>
                    <button onclick="checkAnswer('incorrect', 'q1', this)">Use weak passwords</button>
                    <button onclick="checkAnswer('incorrect', 'q1', this)">Click on suspicious links</button>
                    <p class="answer" id="answer-q1"></p>
                </li><br>
                <li>
                    <p>What should you do if you receive an email from an unknown sender with an attachment?</p>
                    <button onclick="checkAnswer('incorrect', 'q2', this)">Open the attachment immediately</button>
                    <button onclick="checkAnswer('incorrect', 'q2', this)">Forward it to a colleague</button>
                    <button onclick="checkAnswer('correct', 'q2', this)">Delete it and report it</button>
                    <p class="answer" id="answer-q2"></p>
                </li><br>
                <li>
                    <p>How often should you change your email password?</p>
                    <button onclick="checkAnswer('incorrect', 'q3', this)">Once every two years</button>
                    <button onclick="checkAnswer('incorrect', 'q3', this)">Once a year</button>
                    <button onclick="checkAnswer('correct', 'q3', this)">Regularly, at least every 3-6 months</button>
                    <p class="answer" id="answer-q3"></p>
                </li><br>
                <li>
                    <p>What is the benefit of encrypting sensitive emails?</p>
                    <button onclick="checkAnswer('incorrect', 'q4', this)">To speed up email delivery</button>
                    <button onclick="checkAnswer('incorrect', 'q4', this)">To increase email storage</button>
                    <button onclick="checkAnswer('correct', 'q4', this)">To protect data during transmission</button>
                    <p class="answer" id="answer-q4"></p>
                </li><br>
                <li>
                    <p>Which of the following is a sign of suspicious activity in your inbox?</p>
                    <button onclick="checkAnswer('incorrect', 'q5', this)">Receiving a large amount of spam</button>
                    <button onclick="checkAnswer('correct', 'q5', this)">Unusual login attempts</button>
                    <button onclick="checkAnswer('incorrect', 'q5', this)">Regular promotional emails</button>
                    <p class="answer" id="answer-q5"></p>
                </li><br>
                <li>
                    <p>Why is it important to use two-factor authentication (2FA) for email accounts?</p>
                    <button onclick="checkAnswer('incorrect', 'q6', this)">It makes logging in easier</button>
                    <button onclick="checkAnswer('correct', 'q6', this)">It provides an extra layer of security</button>
                    <button onclick="checkAnswer('incorrect', 'q6', this)">It speeds up email access</button>
                    <p class="answer" id="answer-q6"></p>
                </li><br>
                <li>
                    <p>What should you do if you accidentally click on a phishing link?</p>
                    <button onclick="checkAnswer('incorrect', 'q7', this)">Ignore it and continue as usual</button>
                    <button onclick="checkAnswer('correct', 'q7', this)">Report it and change your password immediately</button>
                    <button onclick="checkAnswer('incorrect', 'q7', this)">Forward it to your contact list</button>
                    <p class="answer" id="answer-q7"></p>
                </li><br>
            </ul>

            <!-- Submit Button -->
            <button id="submit-button" onclick="submitQuiz()">Submit Quiz</button>
            <p id="result-message"></p>
        </section>
    </main>

    <script>
        let score = 0;
        let totalQuestions = 7;  // total number of questions

        function checkAnswer(response, question, button) {
            const correctAnswers = {
                'q1': 'correct',
                'q2': 'correct',
                'q3': 'correct',
                'q4': 'correct',
                'q5': 'correct',
                'q6': 'correct',
                'q7': 'correct'
            };

            const answers = {
                'q1': 'Enable two-factor authentication (2FA) for all email accounts.',
                'q2': 'Delete it and report it.',
                'q3': 'Regularly, at least every 3-6 months.',
                'q4': 'To protect data during transmission.',
                'q5': 'Unusual login attempts.',
                'q6': 'It provides an extra layer of security.',
                'q7': 'Report it and change your password immediately.'
            };

            const buttons = button.parentElement.querySelectorAll('button');
            buttons.forEach(btn => btn.disabled = true); // Disable all buttons in the question

            if (response === correctAnswers[question]) {
                button.classList.add('correct');
                button.innerHTML += ' &#10004;'; // Add tick symbol
                score++;  // Increment score for the correct answer
            } else {
                button.classList.add('incorrect');
                button.innerHTML += ' &#10060;'; // Add cross symbol
                document.getElementById(`answer-${question}`).innerText = `Correct answer: ${answers[question]}`;
            }
        }

        function submitQuiz() {
    const resultMessage = document.getElementById('result-message');
    resultMessage.innerHTML = `You answered ${score} out of ${totalQuestions} questions correctly.`;
    document.getElementById('submit-button').disabled = true; // Disable submit button after submission

    // Assuming you have the employee ID stored in a variable
    let employeeId = "EMP123"; // Replace this with the actual employee ID

    // AJAX request to submit the quiz score
    $.ajax({
        type: "POST",
        url: "submit_quiz.php",
        data: {
            employee_id: employeeId,
            score: score,
            total_questions: totalQuestions
        },
        success: function(response) {
            alert("Score submitted successfully: " + response);  // Success response from PHP script
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", xhr.responseText);
            alert("Error submitting the score. Status: " + status + ". Error: " + error);
        }
    });
}

    </script>

<div id="footer"></div>

</body>
</html>
