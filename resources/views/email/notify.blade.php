<strong>Заполнена форма обратной связи</strong>
<br>
@isset($data['name'])
    <strong>Имя: </strong> {{$data['name']}}
@endisset
<br>
@isset($data['phone'])
    <strong>Телефон: </strong> {{$data['phone']}}
@endisset
<br>
@isset($data['message'])
    <strong>Сообщение: </strong> {{$data['message']}}
@endisset