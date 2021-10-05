
@extends('layouts.base')
@section('title', 'Phone Numbers')

@section('content')
    @php
        $page = $paging->getPage();
        $limit = $paging->getLimit();
    @endphp
<section class="customers--phone--numbers">

    <form>
        <div class="row mb-3">
            <div class="col-md-3 mt-0">
                <select class="form-select w-100 min-h-30" name="country" onchange="filterCountry()" id="country">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{$country['code']}}" {{ ($filter->getCountryCode() == $country['code']) ? 'selected' : '' }}>{{ $country['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 m-0">
                <select class="form-select w-100 min-h-30" name="state" onchange="filterState()" id="state">
                    <option value="">Select valid/invalid Phone Numbers</option>

                    <option value="1" {{ ($filter->isValidState()) ? 'selected': '' }}>Valid</option>
                    <option value="0" {{ ($filter->isInvalidState()) ? 'selected': '' }}>Invalid</option>
                </select>
            </div>
        </div>

        <table class="table table-light mt-0">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Country</th>
                <th scope="col">State</th>
                <th scope="col">Country Code</th>
                <th scope="col">Phone num.</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                @if (! empty($customer['phone']) && ! empty($customer['phone']['country']['name']))
                    <tr>
                        <th scope="row">{{ $customer['phone']['country']['name'] }}</th>
                        <td>
                            @if ($customer['phone']['isValid'])
                                <span class="text-success">Ok</span>
                            @else
                                <span class="text-danger">NOk</span>
                            @endif
                        </td>
                        <td>{{ $customer['phone']['country']['code'] }}</td>
                        <td>
                            @if ($customer['phone']['isValid'])
                                <span class="text-success">{{$customer['phone']['number']}}</span>
                            @else
                                <span class="text-danger">{{$customer['phone']['number']}}</span>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        @if (! $filter->hasState())
            <div class="buttons">
                @if ($paging->getPage() == 1)
                    <button type="button" class="btn btn-primary" disabled>Prev</button>
                @else
                    <button type="button" class="btn btn-primary" onclick="goPrev()">
                        <span aria-hidden="true">&larr;</span>Prev
                    </button>
                @endif

                @if (count($customers) < $limit)
                    <button type="button" class="btn btn-primary" disabled>Next</button>
                @else
                    <button type="button" class="btn btn-primary" onclick="goNext()">
                        Next
                        <span aria-hidden="true">&rarr;</span>
                    </button>
                @endif
            </div>
        @endif
    </form>

</section>
@endsection

@section('scripts')
    <script>
        let query = {
            countryCode: "{{ $filter->getCountryCode() }}",
            state: "{{ $filter->getState() }}",
            page: parseInt("{{$page}}"),
            limit: parseInt("{{$limit}}")
        };

        serialize = function(obj) {
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        }

        function filterCountry() {
            var selected = document.getElementById('country');
            var value = selected.options[selected.selectedIndex].value;
            query.countryCode = value.replace('+', '')

            return redirect();
        }

        function filterState() {
            var selected = document.getElementById('state');
            var value = selected.options[selected.selectedIndex].value;
            query.state =value;

            if (value !== "") {
                delete query.page;
                delete query.limit;
            }

            return redirect();
        }

        function redirect() {
            window.location.href = '/?' + serialize(query);
        }

        function goPrev() {
            query.page = query.page - 1;

            return redirect();
        }

        function goNext() {
            query.page = query.page + 1;

            return redirect();
        }

    </script>
@endsection
