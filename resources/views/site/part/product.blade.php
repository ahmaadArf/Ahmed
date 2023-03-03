  <!-- Block2 -->
  <div class="block2">
    <div class="block2-pic hov-img0">
        <img src="{{ asset('image/product/'.$product->image) }}" alt="IMG-PRODUCT">
    </div>

    <div class="block2-txt flex-w flex-t p-t-14">
        <div class="block2-txt-child1 flex-col-l ">
            <a href="{{ route('site.product_detail',$product->id) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                {{ $product->name }}
            </a>

            <span class="stext-105 cl3">
                ${{ $product->price }}
            </span>
        </div>

        <div class="block2-txt-child2 flex-r p-t-3">
            <form action="{{ route('site.add_to_favorite') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button >
                    <i class="{{ in_array($product->id,$favorites)?'fas':'far' }} fa-heart"></i>
                </button>
            </form>
        </div>
    </div>
</div>
