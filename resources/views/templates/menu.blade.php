
    <div class="container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Меню:</h3>
            </div>
            <br>
            <form id="contactform" method="POST" class="validateform">
                {{ csrf_field() }}
                <button class="btn btn-theme margintop10 pull-left" type="submit">Обновить</button>
            </form>
        </div>
    </div>

