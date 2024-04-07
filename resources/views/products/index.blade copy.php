@extends('layouts.app')

@section('content')
    <div class="mx-auto p-5">

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-semibold">Product Listings</h1>
            <a href="{{ route('products.create') }}" class="ml-3 inline-flex items-center px-12 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create New Product
            </a>
        </div>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        @if(isset($products) && $products->count())
            <div class="mt-6 flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-8 lg:-mx-10">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No
                                        </th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">
                                            Price (RM)
                                        </th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Details
                                        </th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Publish
                                        </th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($products as $product)
                                    <tr>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                            {{ number_format($product->price, 2) }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 overflow-hidden overflow-ellipsis max-w-xs">
                                            {{ $product->description }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $product->is_published == 'yes' ? 'Yes' : 'No' }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-right">
                                            <!-- Show product details in a new tab -->
                                            <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Show</a>

                                            <!-- Open the edit page in a new tab -->
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-semibold text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="mt-4 text-gray-500">No products found.</div>
        @endif
    </div>
@endsection
