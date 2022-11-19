<link rel="stylesheet" href="{{ assets('plugins/orgChart/src/css/jquery.orgchart.css') }}">
<style type="text/css">
    .orgchart {
        background: #fff;
    }

    .orgchart td.left,
    .orgchart td.right,
    .orgchart td.top {
        border-color: #aaa;
    }

    .orgchart td>.down {
        background-color: #aaa;
    }

    .orgchart .middle-level .title {
        background-color: #006699;
    }

    .orgchart .middle-level .content {
        border-color: #006699;
    }

    .orgchart .product-dept .title {
        background-color: #009933;
    }

    .orgchart .product-dept .content {
        border-color: #009933;
    }

    .orgchart .rd-dept .title {
        background-color: #993366;
    }

    .orgchart .rd-dept .content {
        border-color: #993366;
    }

    .orgchart .pipeline1 .title {
        background-color: #996633;
    }

    .orgchart .pipeline1 .content {
        border-color: #996633;
    }

    .orgchart .frontend1 .title {
        background-color: #cc0066;
    }

    .orgchart .frontend1 .content {
        border-color: #cc0066;
    }

</style> 
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div id="chart-container"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ assets('plugins/orgChart/src/js/jquery.orgchart.js') }}"></script>
<script type="text/javascript">
    $(function() {  
        $('#chart-container').orgchart({
            'data': '{{ route('structure.nodes', $structure->id) }}',
            'nodeContent': 'title'
        });

    });
</script>
