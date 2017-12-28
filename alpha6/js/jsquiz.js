(function () {
    var questions = [{
        question: "What is 2*5?",
        choices: [2, 5, 10, 15, 20],
        correctAnswer: 10
    }, {
        question: "What is 3*6?",
        choices: [3, 6, 9, 12, 18],
        correctAnswer: 18
    }, {
        question: "What is 8*9?",
        choices: [72, 99, 108, 134, 156],
        correctAnswer: 72
    }, {
        question: "What is 1*7?",
        choices: [4, 5, 6, 7, 8],
        correctAnswer: 7
    }, {
        question: "What is 8*8?",
        choices: [20, 30, 40, 50, 64],
        correctAnswer: 64
    }];

    var questionCounter = 0; //Tracks question number
    var selections = []; //Array containing user choices
    var quiz = $('#quiz'); //Quiz div object

    // Display initial question
    displayNext();

    // Click handler for the 'next' button
    $('#next').on('click', function (e) {
        e.preventDefault();

        // Suspend click listener during fade animation
        if (quiz.is(':animated')) {
            return false;
        }
        choose();

        // If no user selection, progress is stopped
        if (isNaN(selections[questionCounter])) {
            alert('Please make a selection!');
        } else {
            questionCounter++;
            displayNext();
        }
    });

    // Click handler for the 'prev' button
    $('#prev').on('click', function (e) {
        e.preventDefault();

        if (quiz.is(':animated')) {
            return false;
        }
        choose();
        questionCounter--;
        displayNext();
    });

    // Click handler for the 'Start Over' button
    $('#start').on('click', function (e) {
        e.preventDefault();

        if (quiz.is(':animated')) {
            return false;
        }
        questionCounter = 0;
        selections = [];
        displayNext();
        $('#start').hide();
    });


    // Creates and returns the div that contains the questions and 
    // the answer selections
    function createQuestionElement(index) {
        var qElement = $('<div>', {
            id: 'question'
        });

        var header = $('<section class="question"><div class="stem"><div class="qst">' + (index + 1) + ':'+ questions[index].question +'</div></div></section>');
        qElement.append(header);

        //var question = $('<p>').append(questions[index].question);
        //qElement.append(question);

        var radioButtons = createRadios(index);
        qElement.append(radioButtons);

        return qElement;
    }

    // Creates a list of the answer choices as radio inputs
    function createRadios(index) {
        var radioList = $('<ul class="options">');
        var item;
        var input = '';
        for (var i = 0; i < questions[index].choices.length; i++) {
            item = $('<li  class="option">');
            input = '<label><input type="radio" name="answer" value=' + questions[index].choices[i] + ' />' + questions[index].choices[i] + '</label>';
            //input += questions[index].choices[i];
            item.append(input);
            radioList.append(item);
        }
        return radioList;
    }

    // Reads the user selection and pushes the value to an array
    function choose() {
        selections[questionCounter] = +$('input[name="answer"]:checked').val();
    }

    // Displays next requested element
    function displayNext() {
        quiz.fadeOut(function () {
            $('#question').remove();
            $('#score_alert').remove();

            if (questionCounter < questions.length) {
                var nextQuestion = createQuestionElement(questionCounter);
                quiz.append(nextQuestion).fadeIn();
                if (!(isNaN(selections[questionCounter]))) {
                    $('input[value=' + selections[questionCounter] + ']').prop('checked', true);
                }

                // Controls display of 'prev' button
                if (questionCounter === 1) {
                    $('#prev').show();
                } else if (questionCounter === 0) {

                    $('#prev').hide();
                    $('#next').show();
                }
            } else {
                var scoreElem = displayScore();
                quiz.append(scoreElem).fadeIn();
                $('#next').hide();
                $('#prev').hide();
                $('#start').show();
            }
        });
    }

    // Computes score and returns a paragraph element to be displayed
    function displayScore() {
        var score = $('<p id="score_alert" class="alert alert-warning text-center">', { id: 'question' });

        var numCorrect = 0;
        for (var i = 0; i < selections.length; i++) {
            if (selections[i] === questions[i].correctAnswer) {
                numCorrect++;
            }
        }
        var request = $.ajax({
            url: "lti/grade_post.php",
            method: "POST",
            data: { score: parseInt(numCorrect), 
                lis_result_sourcedid : lis_result_sourcedid,
                lis_outcome_service_url : lis_outcome_service_url,
                custom_canvas_assignment_points_possible : custom_canvas_assignment_points_possible
            },
        dataType: "html"
        });
    
        request.done(function (msg) {
            //$( "#log" ).html( msg );
        });
        score.append('<strong>Score : ' + numCorrect + '</strong> out of <strong>' +
            questions.length + '</strong>');
        return score;
    }
})();