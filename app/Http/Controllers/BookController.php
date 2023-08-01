<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Models\book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $book;

    public function __construct(book $book){
        $this->book = $book;
    }

    public function store(Request $request)
    {
        // Request 에 대한 유효성 검사입니다, 다양한 종류가 있기에 공식문서를 보시는 걸 추천드립니다.
        // 유효성에 걸린 에러는 errors 에 담깁니다.
        $request = $request->validate([
            'name' => 'required',
            'url' => 'required'
        ]);
        $book = $this->book->create($request);
        return $book;
    }

    public function index(PaginationRequest $request){
        $books = $this->book->latest()->paginate($request->getPerPage(), '*', null, $request->getPage());
        return $books;
    }

    // 상세 페이지
    public function show(int $bookId){
        $book = $this->book->where('id', $bookId)->first();
        return $book;
    }

    public function update(Request $request, int $bookId){
        $request = $request->validate([
            'name' => 'required',
            'url' => 'required'
        ]);
        // $book 수정할 모델 값이므로 바로 업데이트 해줍시다.
        $book = $this->book->where('id', $bookId)->first();
        if($book)
            $book->update($request);

        return $book;
    }

    public function destroy(int $bookId){
        $book = $this->book->where('id', $bookId)->first();
        if($book)
            $book->delete();
        return $book;
    }
}