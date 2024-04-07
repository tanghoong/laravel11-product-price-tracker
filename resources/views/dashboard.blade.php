<x-app-layout>

    <div class="mx-auto p-5">

        <form action="{{ route('home') }}" method="GET" class="flex items-center">
            <div class="w-full flex rounded-md shadow-sm">
                <input type="text" name="query" value="{{ $query ?? '' }}" placeholder="Search products..." class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="submit" class="ml-3 inline-flex items-center px-12 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Search') }}
                </button>
            </div>
        </form>

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
                                            Description
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
                                                RM{{ number_format($product->price, 2) }}
                                            </td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 overflow-hidden overflow-ellipsis max-w-xs">
                                                {{ $product->description }}
                                            </td>
                                            <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium text-right">
                                                <a href="{{ route('products.show', $product->id) }}" class="text-indigo-600 hover:text-indigo-900">Show</a>
                                                <a href="{{ route('products.edit', $product->id) }}" class="ml-4 text-indigo-600 hover:text-indigo-900">Edit</a>
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





</x-app-layout>
