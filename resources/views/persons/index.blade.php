@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">聯絡人</div>

        <div class="card-body">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            @{{ message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <button class="btn btn-primary btn-sm mb-2" type="button" @click="create()">新增</button>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">姓名</th>
                <th scope="col">地址</th>
                <th scope="col">生日</th>
                <th scope="col">手機</th>
                <th scope="col">電郵</th>
                <th scope="col">操作</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="person in persons" :key="person.id">
                <td class="text-nowrap">@{{ person.name }}</td>
                <td class="text-nowrap">@{{ person.address }}</td>
                <td class="text-nowrap">@{{ person.birthday }}</td>
                <td class="text-nowrap">@{{ person.mobile }}</td>
                <td class="text-nowrap">@{{ person.email }}</td>
                <td class="text-nowrap">
                  <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#createForm">編輯</button>
                  <button class="btn btn-danger btn-sm" type="button">刪除</button>
                </td>
              </tr>
            </tbody>
            <tfoot v-if="persons.length == 0">
              <tr>
                <td colspan="100">無資料</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createForm" tabindex="-1" aria-labelledby="createFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createFormLabel">新增聯絡人</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="createForm">
        <!-- 編輯用的隱藏欄位 -->
        <input type="text" name="id">
        <div class="form-group">
          <label for="name">姓名</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
          <label for="address">地址</label>
          <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
          <label for="birthday">生日</label>
          <input type="date" class="form-control" id="birthday" name="birthday">
        </div>
        <div class="form-group">
          <label for="mobile">手機</label>
          <input type="text" class="form-control" id="mobile" name="mobile">
        </div>
        <div class="form-group">
          <label for="email">電郵</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary">儲存</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

  'use strict'

  var app = new Vue({
    el: '#app',
    data: {
      message: 'Hello vue !',
      persons: []
    },
    created: function(){
      const url = "{{ route('api.persons') }}";
      console.log(url);

      axios.get(url)
        .then(function(res){
          console.log(res);
          app.persons = res.data;
        });

      console.log('vue created');
    },
    methods: {
      create: function(){
        $("#createForm").find('input').val("");
        $("#createForm").modal('show');
        console.log('persons.create');
      }
    }
  })

@endsection