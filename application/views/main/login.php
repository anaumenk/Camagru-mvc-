<div id="shade"></div>
<div id="entering">
    <form id="login_form" method="post" action="/enter/login" onsubmit="message(this);">
        <a href="/enter" id="close"><i class="fas fa-times"></i></a>
        <input id="log_login" type="text" name="log_login" placeholder="Enter your login" required>
        <input id="log_password" type="password" name="log_password" placeholder="Enter your password" required>
        <a href="/enter/login/recover">Forget your password?</a>
        <input type="submit" name="log_submit" value="OK" style="width: 15%;">
    </form>
</div>