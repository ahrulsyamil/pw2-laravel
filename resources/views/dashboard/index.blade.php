@extends('layouts.master')
@section('content')
    <div class="row ">
        <div class="col-6">
            <div id="category" style="height: 300px"></div>
        </div>
        <div class="col-6">
            <div id="supplier" style="height: 300px"></div>
        </div>
        <div class="col-12 mt-5">
            <div id="status" style="height: 300px"></div>
        </div>
    </div>

    <script>
        const category = new CanvasJS.Chart("category", {
            animationEnabled: true,
            theme: "light1",
            title: {
                text: "Category"
            },
            axisY: {
                title: "Total"
            },
            data: [{
                type: "column",
                legendMarkerColor: "grey",
                dataPoints: {!! json_encode($category) !!}.map(item => {
                    return {
                        y: item.total,
                        label: item.category
                    }
                })
            }]
        });
        category.render();
        const supplier = new CanvasJS.Chart("supplier", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Supplier"
            },
            axisY: {
                title: "Total"
            },
            data: [{
                type: "column",
                legendMarkerColor: "grey",
                dataPoints: {!! json_encode($supplier) !!}.map(item => {
                    return {
                        y: item.total,
                        label: item.supplier
                    }
                })
            }]
        });
        supplier.render();
        const status = new CanvasJS.Chart("status", {
            animationEnabled: true,
            title: {
                text: "Status"
            },
            axisY: {
                title: "Total"
            },
            data: [{
                type: "doughnut",
                legendMarkerColor: "grey",
                dataPoints: {!! json_encode($status) !!}.map(item => {
                    return {
                        y: item.total,
                        label: item.status
                    }
                })
            }]
        });
        status.render();
    </script>
@endsection
