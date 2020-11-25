<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('persons/index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 可改寫
        // $request->validate()
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'address' => 'required',
                'birthday' => 'required',
                'mobile' => 'required',
                'email' => 'required'
            ],
            // $messages, $customAttributes
            [
                'required' => '「:attribute」是必填欄位。'
            ],
            [
                'name' => '姓名',
                'address' => '地址',
                'birthday' => '生日',
                'mobile' => '手機',
                'email' => '電子郵件',
            ]
        );
        // 可省略(if)
        // if ($validator->fails())
        //     return redirect()->back()->withErrors($validator)->withInput();
        
            $person = new Person();
            $person->name = $request->name;
            $person->address = $request->address;
            $person->birthday = $request->birthday;
            $person->mobile = $request->mobile;
            $person->email = $request->email;
            $person->save();

            // return redirect()->route('persons.index')->with('success', '已成功新增資料。');

            return [
                'person' => $person,
                'message' => [
                    'type' => 'primary',
                    'body' => '已成功新增資料。'
                ]
            ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $person_id)
    {
        // return $request->all();

        // 驗證
        $request->validate(
            [
                'name' => 'required',
                'address' => 'required',
                'birthday' => 'required',
                'mobile' => 'required',
                'email' => 'required'
            ],
            // $messages, $customAttributes
            [
                'required' => '「:attribute」是必填欄位。'
            ],
            [
                'name' => '姓名',
                'address' => '地址',
                'birthday' => '生日',
                'mobile' => '手機',
                'email' => '電子郵件',
            ]
        );

        // 調出/更新
        $person = Person::find($person_id);
        $person->name = $request->name;
        $person->address = $request->address;
        $person->birthday = $request->birthday;
        $person->mobile = $request->mobile;
        $person->email = $request->email;
        $person->update();

        // 轉回
        // return redirect()->route('persons.index')->with('success', '已成功更新資料。');

        return [
            'person' => $person,
            'message' => [
                'type' => 'success',
                'body' => '已成功更新資料。'
            ]
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($person_id)
    {
        $person = Person::find($person_id);
        $person->delete();
        // return redirect()->route('persons.index')->with('success', '已成功刪除資料。');

        return [
            'person' => $person,
            'message' => [
                'type' => 'warning',
                'body' => '已成功刪除資料。'
            ]
        ];
    }
}
