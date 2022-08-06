<div class="row">
    <div class="col-sm-8">
        {{ $items->onEachSide(2)->withQueryString()->links() }}
    </div>

    <div class="col-sm-4">
        Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} out
        of {{ $items->total() }} results
    </div>
</div>
