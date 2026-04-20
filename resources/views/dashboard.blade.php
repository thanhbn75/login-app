<h1>Dashboard</h1>
<p>Họ tên sinh viên: {{ auth()->user()->name }}</p>
<p>Email: {{ auth()->user()->email }}</p>
<p>Mã sinh viên: {{ auth()->user()->student_id }}</p>
<img src="{{ auth()->user()->avatar }}" width="100">

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>