from flask import Flask, request, render_template, redirect, make_response

app = Flask(__name__)

# Пример данных для проверки логина и пароля
VALID_CREDENTIALS = {"username": "admin", "password": "1234"}


@app.route("/", methods=["GET", "POST"])
def login():
    username = request.cookies.get("username")

    # Если куки уже есть
    if username:
        return render_template("welcome.html", username=username)

    # Если нет куки, проверяем POST-запрос
    if request.method == "POST":
        login = request.form.get("login")
        password = request.form.get("password")

        # Проверка логина и пароля
        if login == VALID_CREDENTIALS["username"] and password == VALID_CREDENTIALS["password"]:
            resp = make_response(redirect("/"))
            resp.set_cookie("username", login)
            return resp
        else:
            return render_template("login.html", error="Неверный логин или пароль!")

    # Если нет POST-запроса, показываем форму авторизации
    return render_template("login.html")


@app.route("/logout")
def logout():
    resp = make_response(redirect("/"))
    resp.delete_cookie("username")
    return resp


if __name__ == "__main__":
    app.run(debug=True)
