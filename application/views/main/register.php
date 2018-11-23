<div id="shade"></div>

<div id="entering">
    <form method="post" id="signup_form" action="/enter/register" onsubmit="message(this);">
        <a href="/enter" id="close"><i class="fas fa-times"></i></a>
        <input id="user_name" type="text" name="login" placeholder="Enter your login" title="Only letters and/or numbers with a maximum 15 characters" required>
        <input id="email" type="email" name="email" placeholder="Enter your email" required>
        <input id="password" type="password" name="password" placeholder="Enter your password" title="Your password may contain 8 characters" required>
        <input id="rep_pass" type="password" name="rep_pass" placeholder="Repeat your password" required>

        <input type="submit" value="Register" name="submit" style="width: 15%;" >
    </form>

</div>