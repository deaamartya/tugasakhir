{{-- Extends layout --}}
@extends('layout.default')

@section('tambahan-style')
	@if(!empty(config('dz.public.pagelevel.css.app_calender'))) 
		@foreach(config('dz.public.pagelevel.css.app_calender') as $style)
						<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
		@endforeach
	@endif
@endsection

{{-- Content --}}
@section('content')
<!-- row -->
<div class="container-fluid">
	<div class="form-head d-flex mb-3 align-items-start">
		<div class="mr-auto d-none d-lg-block">
			<h2 class="text-black font-w600 mb-0">Dashboard</h2>
			<p class="mb-0">Welcome to SILAB!</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-6">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary p-3">
							<!-- <i class="ti-user"></i> -->
							<svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"  fill="#2F4CDD"><g><path d="m126.959 380.639c0 14.377 11.697 26.074 26.074 26.074s26.074-11.697 26.074-26.074c0-14.378-11.697-26.074-26.074-26.074-14.377-.001-26.074 11.696-26.074 26.074zm37.149 0c0 6.106-4.968 11.074-11.074 11.074s-11.075-4.968-11.075-11.074 4.968-11.075 11.075-11.075 11.074 4.968 11.074 11.075z"/><path d="m454.886 219.37c16.64-9.483 16.66-33.468 0-42.962-3.696-2.106-5.794-6.505-4.558-11.04 5.052-18.452-11.859-35.443-30.4-30.369-4.285 1.174-8.816-.703-11.016-4.564-9.482-16.64-33.468-16.659-42.961 0-2.2 3.861-6.73 5.738-11.04 4.558-17.998-4.927-35.451 11.268-30.369 30.4 1.174 4.286-.703 8.815-4.564 11.016-16.64 9.483-16.66 33.468 0 42.961 3.861 2.201 5.738 6.73 4.558 11.04-5.053 18.451 11.86 35.444 30.399 30.369 4.287-1.173 8.817.704 11.016 4.564 9.483 16.642 33.468 16.659 42.961 0 2.2-3.861 6.728-5.738 11.04-4.558 18.428 5.047 35.463-11.842 30.369-30.399-1.173-4.286.704-8.816 4.565-11.016zm-7.426-13.032c-9.653 5.501-14.654 16.905-11.599 28.034 1.984 7.248-4.651 13.945-11.97 11.94-10.9-2.985-22.416 1.789-28.01 11.605-3.73 6.546-13.164 6.551-16.897 0-5.579-9.791-17.083-14.597-28.034-11.598-7.246 1.984-13.945-4.65-11.94-11.971 2.984-10.897-1.789-22.416-11.605-28.01-6.545-3.729-6.552-13.162 0-16.897 9.817-5.594 14.589-17.113 11.63-27.916-2.047-7.707 4.853-13.997 11.939-12.057 10.896 2.982 22.415-1.789 28.009-11.605 3.73-6.546 13.164-6.551 16.897 0 5.595 9.817 17.114 14.587 28.034 11.599 7.198-1.974 13.953 4.589 11.94 11.971-2.983 10.898 1.789 22.416 11.605 28.01 6.545 3.728 6.553 13.161.001 16.895z"/><path d="m482.896 123.547c-2.547-3.266-7.259-3.85-10.526-1.302-3.266 2.547-3.849 7.26-1.302 10.526 14.628 18.758 22.36 41.275 22.36 65.117 0 58.447-47.55 105.996-105.996 105.996-57.144 0-104.033-45.661-105.93-102.414 21.748-21.765 20.958-20.87 22.17-22.353.256-.455 5.622-6.174 5.622-15.814 0-13.475-9.735-19.489-11.546-21.922 19.357-30.665 53.218-49.488 89.685-49.488 23.17 0 45.178 7.341 63.645 21.231 3.311 2.49 8.012 1.824 10.502-1.486s1.824-8.012-1.486-10.502c-21.087-15.859-46.213-24.242-72.661-24.242-40.491 0-78.155 20.34-100.513 53.66l-5.265-5.265c-7.92-7.92-19.867-9.416-29.31-4.492l-93.098-93.098c-13.84-13.838-35.347-15.432-50.963-4.799l-14.763-14.763c-10.849-10.849-28.408-10.85-39.258 0l-19.837 19.836c-10.849 10.849-10.85 28.409 0 39.258l14.757 14.757c-9.007 13.176-9.239 30.492-.858 43.852-28.9 32.587-44.752 74.148-44.752 117.746 0 24.086 4.78 47.478 14.207 69.527 1.628 3.808 6.034 5.574 9.844 3.947 3.809-1.628 5.576-6.036 3.948-9.845-8.626-20.175-12.999-41.583-12.999-63.63 0-39.264 14.042-76.735 39.694-106.351l39.066 39.067c-15.344 19.088-23.717 42.714-23.717 67.284 0 34.478 16.705 66.757 44.292 86.86-12.94 10.089-15.883 19.632-32.568 44.34-15.49-11.313-28.745-25.142-39.474-41.195-2.301-3.444-6.958-4.37-10.403-2.068-3.444 2.302-4.37 6.959-2.068 10.403 11.882 17.779 26.614 33.051 43.843 45.501l-25.372 39.587c-22.847 2.141-40.79 21.42-40.79 44.818v16.605c.001 12.994 10.571 23.564 23.564 23.564h343.721c16.47 0 29.869-13.399 29.869-29.869 0-30.505-24.818-55.322-55.322-55.322h-135.755v-27.1h111.349c12.419 0 22.523-10.104 22.523-22.523 0-25.417-20.678-46.096-46.095-46.096h-110.794c-10.541-8.48-23.919-13.571-38.469-13.571-8.154 0-16.051 1.594-23.329 4.569-27.06-16.848-43.722-46.581-43.722-78.502 0-20.584 6.851-40.396 19.408-56.594l39.058 39.058c-4.895 9.342-3.52 21.299 4.497 29.315l20.303 20.303c9.789 9.789 25.633 9.79 35.424 0l60.38-60.38c3.696 25.809 15.584 49.629 34.38 68.344 22.83 22.733 53.147 35.253 85.367 35.253 66.717 0 120.996-54.279 120.996-120.996-.001-27.215-8.83-52.923-25.533-74.342zm-89.666 358.584c0 8.199-6.67 14.869-14.869 14.869h-343.721c-4.722 0-8.563-3.841-8.563-8.563v-16.605c0-16.555 13.468-30.024 30.023-30.024h296.808c22.234 0 40.322 18.089 40.322 40.323zm-88.3-136.041c17.146 0 31.095 13.95 31.095 31.096 0 4.148-3.375 7.523-7.523 7.523h-111.348c-.377-2.569 2.274-19.959-9.569-38.619zm-102.785 32.583c.001.112.009.222.009.333v47.803h-132.339c50.108-78.175 47.551-74.502 50.563-78.053 8.635-10.053 21.294-16.237 35.289-16.237 25.359 0 46.292 20.475 46.478 46.154zm-53.506-340.367 92.287 92.286-56.03 56.03-28.015 28.014c-99.284-99.285-92.275-92.242-93.253-93.312-8.832-9.856-8.543-25.021.967-34.53l48.488-48.488c9.801-9.801 25.752-9.805 35.556 0zm-103.607.273 19.836-19.836c4.975-4.975 13.07-4.976 18.046 0l14.259 14.259-37.881 37.882-14.26-14.259c-4.975-4.975-4.975-13.071 0-18.046zm151.667 226.481c-3.925 3.926-10.284 3.928-14.212 0l-20.303-20.303c-3.927-3.927-3.928-10.283 0-14.212l31.55-31.55 63.103-63.103c3.927-3.924 10.282-3.925 14.21.002l20.302 20.303c3.825 3.837 4.009 10.179 0 14.212z"/></g></svg>

						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $total_alat_bagus }}</span></h3>
							<p class="mb-0">Stok Alat Bagus</p>
							<small>Lab. {{ Auth::user()->laboratorium->lab() }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-6">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary p-3">
							<!-- <i class="ti-user"></i> -->
							<svg id="Capa_1" enable-background="new 0 0 511.977 511.977" height="512" fill="#2F4CDD" viewBox="0 0 511.977 511.977" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m104.262 350.965c1.263.821 2.681 1.214 4.083 1.214 2.453 0 4.857-1.202 6.294-3.412l73.884-113.598c1.855-2.853 2.836-6.159 2.836-9.562v-86.957l76.19 43.532c1.174.67 2.452.989 3.714.989 2.604 0 5.135-1.358 6.519-3.781 2.055-3.597.805-8.178-2.792-10.233l-25.908-14.803 7.981-2.087c4.007-1.048 6.406-5.146 5.358-9.154-1.048-4.007-5.144-6.408-9.154-5.358l-22.8 5.963-39.109-22.345v-65.741h83.59c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-87.958l-8.666-8.769c-.731-.74-1.133-1.719-1.133-2.758v-10.181c0-2.164 1.76-3.924 3.923-3.924h26.953c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-26.953c-10.435 0-18.923 8.489-18.923 18.924v10.181c0 5.012 1.94 9.736 5.464 13.302l8.703 8.806v174.394c0 .492-.142.971-.411 1.384l-73.884 113.598c-2.257 3.472-1.273 8.118 2.199 10.376z"/><path d="m240.03 15h90.832c2.164 0 3.923 1.76 3.923 3.924v10.181c0 1.039-.402 2.019-1.133 2.758l-8.667 8.77h-20.971c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h16.604v99.787c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-104.207l8.704-8.807c3.523-3.565 5.463-8.289 5.463-13.301v-10.181c.001-10.435-8.488-18.924-18.923-18.924h-90.832c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5z"/><path d="m444.243 393.372-108.214-166.382c-.269-.413-.411-.892-.411-1.384v-38.225c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v38.225c0 3.403.981 6.71 2.836 9.562l32.763 50.374-59.789 57.428c-1.878 1.804-2.686 4.453-2.134 6.998.551 2.545 2.384 4.622 4.84 5.486l17.964 6.321-47.705 52.582c-2.783 3.068-2.552 7.811.515 10.594 1.437 1.303 3.24 1.945 5.037 1.945 2.042 0 4.077-.829 5.557-2.46l55.294-60.947c1.688-1.861 2.333-4.443 1.716-6.879s-2.412-4.401-4.782-5.235l-17.125-6.026 48.938-47.005 67.125 103.206c12.548 19.293 13.488 42.889 2.513 63.119s-31.268 32.308-54.283 32.308h-247.82c-23.015 0-43.308-12.078-54.283-32.308s-10.036-43.826 2.513-63.119l16.902-25.988c2.258-3.473 1.274-8.118-2.198-10.376-3.471-2.258-8.118-1.274-10.376 2.198l-16.902 25.988c-15.596 23.979-16.764 53.307-3.124 78.451 13.641 25.144 38.862 40.155 67.468 40.155h247.821c28.605 0 53.827-15.011 67.468-40.155 13.64-25.145 12.472-54.472-3.124-78.451z"/></g></svg>
						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $total_alat_rusak }}</span></h3>
							<p class="mb-0">Stok Alat Rusak</p>
							<small>Lab. {{ Auth::user()->laboratorium->lab() }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-6">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary">
							<svg height="512" viewBox="0 0 74 74" width="512" xmlns="http://www.w3.org/2000/svg"  fill="#2F4CDD"><g id="_2_PT" data-name="2 PT"><path d="m37 72a23.67 23.67 0 0 1 -7.476-46.127v-19.556h14.952v19.556a23.67 23.67 0 0 1 -7.476 46.127zm-5.476-63.683v19.034l-.715.213a21.667 21.667 0 1 0 12.382 0l-.715-.213v-19.034z"/><path d="m44.556 8.317h-15.112a3.159 3.159 0 1 1 0-6.317h15.112a3.159 3.159 0 1 1 0 6.317zm-15.112-4.317a1.159 1.159 0 1 0 0 2.317h15.112a1.159 1.159 0 1 0 0-2.317z"/><path d="m28 57a5 5 0 1 1 5-5 5.006 5.006 0 0 1 -5 5zm0-8a3 3 0 1 0 3 3 3 3 0 0 0 -3-3z"/><path d="m42 39a3 3 0 1 1 3-3 3 3 0 0 1 -3 3zm0-4a1 1 0 1 0 1 1 1 1 0 0 0 -1-1z"/><path d="m29 42a4 4 0 1 1 4-4 4 4 0 0 1 -4 4zm0-6a2 2 0 1 0 2 2 2 2 0 0 0 -2-2z"/><path d="m23.942 52.677a20.854 20.854 0 0 1 -10.214-3.549l1.2-1.6a19.186 19.186 0 0 0 9.172 3.155z"/><path d="m32.107 51.7-.615-1.9a23.159 23.159 0 0 0 4.984-2.32 21.709 21.709 0 0 1 23.795.053l-1.2 1.6c-.395-.295-9.8-7.142-21.547.053a25.174 25.174 0 0 1 -5.417 2.514z"/></g></svg>
						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $total_bahan }}</span></h3>
							<p class="mb-0">Stok Bahan</p>
							<small>Lab. {{ Auth::user()->laboratorium->lab() }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-6">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary p-3">
							<!-- <i class="ti-user"></i> -->
							<svg id="Capa_1" enable-background="new 0 0 512.08 512.08" height="512" viewBox="0 0 512.08 512.08" width="512" xmlns="http://www.w3.org/2000/svg" fill="#2F4CDD" ><g><path d="m483.71 52.063c-1.789-3.085-5.085-4.983-8.65-4.983h-48.191l-24.16-42.024c-1.784-3.103-5.09-5.016-8.669-5.016h-54.03c-3.573 0-6.875 1.906-8.661 5.001l-22.205 38.467-17.456-9.171c.202-1.404.312-2.838.312-4.297 0-16.542-13.458-30-30-30s-30 13.458-30 30 13.458 30 30 30c7.859 0 15.019-3.042 20.373-8.005l23.44 12.315 25.564 43.736c1.793 3.068 5.08 4.954 8.633 4.954h48.142l21.159 37.57-20.125 30.306c-2.304-.568-4.709-.876-7.186-.876-16.542 0-30 13.458-30 30s13.458 30 30 30c4.552 0 8.948-1.01 12.937-2.921l19.984 19.984c-1.91 3.989-2.921 8.385-2.921 12.937 0 16.542 13.458 30 30 30s30-13.458 30-30-13.458-30-30-30c-4.552 0-8.948 1.01-12.937 2.921l-19.984-19.984c1.91-3.989 2.921-8.385 2.921-12.937 0-6.804-2.28-13.083-6.112-18.122l20.505-30.878h48.667c3.591 0 6.907-1.926 8.687-5.045l27.02-47.37c1.765-3.094 1.751-6.892-.036-9.972zm-221.71-12.023c-5.514 0-10-4.486-10-10s4.486-10 10-10 10 4.486 10 10-4.486 10-10 10zm62.564 16.759 21.219-36.759h42.471l21.237 36.94-21.175 36.06h-42.568zm47.436 153.241c0-5.514 4.486-10 10-10s10 4.486 10 10c0 5.521-4.479 10-10 10-5.514 0-10-4.486-10-10zm80 60c0 5.514-4.486 10-10 10s-10-4.486-10-10c0-5.521 4.479-10 10-10 5.514 0 10 4.486 10 10zm17.251-129h-42.376l-21.321-37.859 21.2-36.141h42.545l21.245 36.671z"/><path d="m193 206.04c-3.285 0-6.36 1.613-8.228 4.316-6.546 9.476-21.772 32.897-21.772 45.684 0 16.542 13.458 30 30 30s30-13.458 30-30c0-12.787-15.226-36.208-21.772-45.684-1.868-2.703-4.943-4.316-8.228-4.316zm0 60c-5.514 0-10-4.486-10-9.988.081-3.058 4.241-11.773 10.002-21.479 5.756 9.695 9.913 18.407 9.998 21.476-.004 5.51-4.488 9.991-10 9.991z"/><circle cx="193" cy="502.04" r="10"/><path d="m266 233.575v-87.535h10c5.523 0 10-4.478 10-10v-40c0-5.522-4.477-10-10-10h-166c-5.523 0-10 4.478-10 10v40c0 5.522 4.477 10 10 10h10v87.535l-115.251 219.554c-3.107 5.784-4.749 12.322-4.749 18.911 0 22.056 17.944 40 40 40h108c5.523 0 10-4.478 10-10s-4.477-10-10-10h-108c-11.028 0-20-8.972-20-20 0-3.354.801-6.542 2.382-9.475.018-.032 61.169-116.525 61.169-116.525h218.897s61.151 116.493 61.169 116.525c1.581 2.933 2.382 6.12 2.382 9.475 0 11.028-8.972 20-20 20h-107.999c-5.523 0-10 4.478-10 10s4.477 10 10 10h108c22.056 0 40-17.944 40-40 0-6.589-1.642-13.127-4.749-18.911zm-146-127.535h146v20h-146zm-25.95 220 44.804-85.353c.752-1.434 1.146-3.028 1.146-4.647v-90h106v90c0 1.619.393 3.214 1.146 4.647l44.804 85.353z"/></g></svg>
						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $total_bahan_kimia }}</span></h3>
							<p class="mb-0">Stok Bahan Kimia</p>
							<small>Lab. {{ Auth::user()->laboratorium->lab() }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary p-3">
							<!-- <i class="ti-user"></i> -->
							<svg height="480pt" viewBox="-48 0 480 480" width="480pt" xmlns="http://www.w3.org/2000/svg" fill="#2F4CDD"><path d="m344 48h-8v-8c-.027344-22.082031-17.917969-39.9726562-40-40h-256c-22.082031.0273438-39.9726562 17.917969-40 40v352c.0273438 22.082031 17.917969 39.972656 40 40h8v8c.027344 22.082031 17.917969 39.972656 40 40h256c22.082031-.027344 39.972656-17.917969 40-40v-352c-.027344-22.082031-17.917969-39.972656-40-40zm-72-32v36.6875l-10.34375-10.34375c-3.125-3.121094-8.1875-3.121094-11.3125 0l-10.34375 10.34375v-36.6875zm-256 376v-352c0-13.253906 10.746094-24 24-24h184v56c0 3.234375 1.949219 6.152344 4.9375 7.390625s6.429688.550781 8.71875-1.734375l18.34375-18.34375 18.34375 18.34375c2.289062 2.285156 5.730469 2.972656 8.71875 1.734375s4.9375-4.15625 4.9375-7.390625v-56h8c13.253906 0 24 10.746094 24 24v352c0 13.253906-10.746094 24-24 24h-256c-13.253906 0-24-10.746094-24-24zm352 48c0 13.253906-10.746094 24-24 24h-256c-13.253906 0-24-10.746094-24-24v-8h232c22.082031-.027344 39.972656-17.917969 40-40v-328h8c13.253906 0 24 10.746094 24 24zm0 0"/><path d="m127.449219 77.238281c-1.152344-3.125-4.117188-5.214843-7.449219-5.238281h-64c-4.417969 0-8 3.582031-8 8v64c0 4.417969 3.582031 8 8 8h64c4.417969 0 8-3.582031 8-8v-44.6875l21.65625-21.65625-11.3125-11.3125zm-15.449219 58.761719h-48v-48h48v4.6875l-16 16-10.34375-10.34375-11.3125 11.3125 16 16c3.125 3.121094 8.1875 3.121094 11.3125 0l10.34375-10.34375zm0 0"/><path d="m138.34375 178.34375-10.894531 10.894531c-1.152344-3.125-4.117188-5.214843-7.449219-5.238281h-64c-4.417969 0-8 3.582031-8 8v64c0 4.417969 3.582031 8 8 8h64c4.417969 0 8-3.582031 8-8v-44.6875l21.65625-21.65625zm-26.34375 69.65625h-48v-48h48v4.6875l-16 16-10.34375-10.34375-11.3125 11.3125 16 16c3.125 3.121094 8.1875 3.121094 11.3125 0l10.34375-10.34375zm0 0"/><path d="m120 288h-64c-4.417969 0-8 3.582031-8 8v64c0 4.417969 3.582031 8 8 8h64c4.417969 0 8-3.582031 8-8v-64c0-4.417969-3.582031-8-8-8zm-8 64h-48v-48h48zm0 0"/><path d="m160 120h80v16h-80zm0 0"/><path d="m160 88h48v16h-48zm0 0"/><path d="m160 232h80v16h-80zm0 0"/><path d="m160 200h48v16h-48zm0 0"/><path d="m160 336h80v16h-80zm0 0"/><path d="m160 304h48v16h-48zm0 0"/><path d="m224 304h16v16h-16zm0 0"/></svg>
						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $beban_lab_semester }}</span></h3>
							<p class="mb-0">Beban Praktikum Semester</p>
							<small>Lab. {{ Auth::user()->laboratorium->lab() }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary p-3">
							<!-- <i class="ti-user"></i> -->
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" fill="#2F4CDD">
								<g>
									<g>
										<path d="M488.399,492h-21.933V173.536c0-14.823-12.06-26.882-26.882-26.882H390.56c-14.823,0-26.882,12.06-26.882,26.882V492
											h-55.692V317.825c0-14.823-12.059-26.882-26.882-26.882H232.08c-14.823,0-26.882,12.06-26.882,26.882V492h-55.692v-90.204
											c0-14.823-12.06-26.882-26.882-26.882H73.599c-14.823,0-26.882,12.06-26.882,26.882V492H23.601c-5.523,0-10,4.477-10,10
											s4.477,10,10,10h464.798c5.523,0,10-4.477,10-10S493.922,492,488.399,492z M129.504,492H66.716v-90.204
											c0-3.795,3.087-6.882,6.882-6.882h49.024c3.795,0,6.882,3.087,6.882,6.882V492z M287.985,492h-62.788V317.825
											c0-3.795,3.087-6.882,6.882-6.882h49.024c3.794,0,6.882,3.087,6.882,6.882V492z M446.466,492h-62.788V173.536
											c0-3.795,3.087-6.882,6.882-6.882h49.024c3.795,0,6.882,3.087,6.882,6.882V492z"/>
									</g>
								</g>
								<g>
									<g>
										<path d="M466.442,10.516c0.14-2.729-0.82-5.504-2.904-7.588c-2.084-2.084-4.859-3.045-7.588-2.904
											C455.789,0.017,455.63,0,455.466,0h-60.5c-5.523,0-10,4.477-10,10s4.477,10,10,10h37.357l-98.857,98.858l-37.28-37.28
											c-1.875-1.875-4.419-2.929-7.071-2.929c-2.652,0-5.196,1.054-7.071,2.929l-179.769,179.77c-3.905,3.905-3.905,10.237,0,14.143
											c1.953,1.951,4.512,2.927,7.071,2.927s5.119-0.976,7.071-2.929L289.115,102.79l37.28,37.28c3.905,3.905,10.237,3.905,14.143,0
											L446.466,34.143v33.81c0,5.523,4.477,10,10,10s10-4.477,10-10V11C466.466,10.837,466.449,10.678,466.442,10.516z"/>
									</g>
								</g>
								<g>
									<g>
										<circle cx="75.64" cy="303.31" r="10"/>
									</g>
								</g>
							</svg>
						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $beban_lab_tahun }}</span></h3>
							<p class="mb-0">Beban Praktikum dalam Tahun {{ date('Y') }}</p>
							<small>Lab. {{ Auth::user()->laboratorium->lab() }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary p-3">
							<!-- <i class="ti-user"></i> -->
							<svg height="512" viewBox="0 0 60 52" width="512" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="017---Message-Notification" fill="#2F4CDD"><path id="Shape" d="m51 0h-42c-4.96827817.00551113-8.99448887 4.03172183-9 9v24c.00551113 4.9682782 4.03172183 8.9944889 9 9h4v7.845c-.0050552.7813023.449142 1.4927474 1.16 1.817.2655603.1239141.5549529.1884132.848.189.472808-.0011455.9297613-.1705976 1.289-.478l11.069-9.373h23.634c4.9682782-.0055111 8.9944889-4.0317218 9-9v-24c-.0055111-4.96827817-4.0317218-8.99448887-9-9zm7 33c-.0044086 3.8641657-3.1358343 6.9955914-7 7h-23.634c-.4731785.0001886-.9309648.1681381-1.292.474l-11.074 9.371v-7.845c0-1.1045695-.8954305-2-2-2h-4c-3.86416566-.0044086-6.99559136-3.1358343-7-7v-24c.00440864-3.86416566 3.13583434-6.99559136 7-7h42c3.8641657.00440864 6.9955914 3.13583434 7 7z" fill-rule="nonzero"/><path id="Path" d="m55 32c-.5522847 0-1 .4477153-1 1 0 1.6568542-1.3431458 3-3 3-.5522847 0-1 .4477153-1 1s.4477153 1 1 1c2.7600532-.0033061 4.9966939-2.2399468 5-5 0-.5522847-.4477153-1-1-1z"/><path id="Path" d="m9 4c-2.76005315.00330612-4.99669388 2.23994685-5 5 .00000001.55228474.44771526.99999998 1 .99999998s.99999999-.44771524 1-.99999998c0-1.65685425 1.34314575-3 3-3 .55228473-.00000002.99999996-.44771527.99999996-1s-.44771523-.99999998-.99999996-1z"/><path id="Shape" d="m39.211 24.187c-.1383404-.2780955-.210552-.5843958-.211-.895v-5.292c-.0067417-3.8095113-2.4091488-7.2029114-6-8.475v-1.525c-.0082058-1.65344336-1.3465566-2.99179417-3-3-1.6568542 0-3 1.34314575-3 3v1.525c-3.5908512 1.2720886-5.9932583 4.6654887-6 8.475v5.292c-.000349.310296-.0725699.6162936-.211.894l-1.513 3.025c-.6200693 1.2400124-.5538199 2.7126826.1750856 3.8920101s2.0165102 1.8971161 3.4029144 1.8969899h3.146c0 2.209139 1.790861 4 4 4s4-1.790861 4-4h3.146c1.3864042.0001262 2.6740089-.7176624 3.4029144-1.8969899s.7951549-2.6519977.1750856-3.8920101zm-10.211-16.187c0-.55228475.4477153-1 1-1 .2696918-.00067119.5276905.11005477.713.306.1854514.18309032.2889672.4334037.287.694v1.059c-.6643438-.07870466-1.3356562-.07870466-2 0zm1 27c-1.1045695 0-2-.8954305-2-2h4c0 1.1045695-.8954305 2-2 2zm8.847-4.949c-.3586747.5950119-1.0052784.9559688-1.7.949h-14.293c-.6947216.0069688-1.3413253-.3539881-1.7-.949-.3669035-.5888676-.4002563-1.3264201-.088-1.946l1.513-3.025c.2764111-.5555334.4205039-1.1675001.421-1.788v-5.292c0-3.8659932 3.1340068-7 7-7s7 3.1340068 7 7v5.292c.0009057.6208875.1453324 1.2331609.422 1.789l1.513 3.019c.3141426.6209149.2807661 1.3608877-.088 1.951z" fill-rule="nonzero"/></g></g></svg>
						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $jadwal_ulang }}</span></h3>
							<p class="mb-0">Permintaan Penjadwalan Ulang</p>
							<small>Lab. {{ Auth::user()->laboratorium->lab() }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header border-0 pb-0 d-sm-flex d-block">
					<div>
						<h4 class="card-title mb-1">Peminjaman Alat dan Bahan</h4>
						<small class="mb-0">Lab. {{ Auth::user()->laboratorium->lab() }}</small>
					</div>
				</div>
				<div class="card-body orders-summary">
					<div class="row">
						<div class="col-sm-4 mb-4">
							<div class="border px-3 py-3 rounded-xl">
								<h2 class="fs-32 font-w600 counter">{{ $menunggu_penjadwalan }}</h2>
								<p class="fs-16 mb-0">Menunggu Penjadwalan</p>
							</div>
						</div>
						<div class="col-sm-4 mb-4">
							<div class="border px-3 py-3 rounded-xl">
								<h2 class="fs-32 font-w600 counter">{{ $sedang_pinjam }}</h2>
								<p class="fs-16 mb-0">Sedang Pinjam</p>
							</div>
						</div>
						<div class="col-sm-4 mb-4">
							<div class="border px-3 py-3 rounded-xl">
								<h2 class="fs-32 font-w600 counter">{{ $dikembalikan }}</h2>
								<p class="fs-16 mb-0">Dikembalikan</p>
							</div>
						</div>
					</div>
					<div class="widget-timeline-icon">
						<div class="row align-items-center">
							<div class="col-xl-3 col-lg-2 col-xxl-4 col-sm-3 col-md-3 my-2 text-center text-sm-left">
									<div id="chart-donut" class="d-inline-block"></div>
							</div>	
							<div class="col-xl-9 col-lg-10 col-xxl-8 col-sm-9 col-md-9">
								<div class="d-flex align-items-center mb-3">
								@php
								if(intval($total_peminjaman) == 0){ 
									$persen_belum_pinjam = 0; 
								}
								else {
									$persen_belum_pinjam = intval(($menunggu_penjadwalan/$total_peminjaman)*100);
								}
								@endphp
									<p class="mb-0 fs-14 mr-2 col-4 col-xxl-5 px-0">
									Belum Pinjam ({{$persen_belum_pinjam}}%)
									</p>
									<div class="progress mb-0" style="height:8px; width:100%;">
										<div class="progress-bar bg-warning progress-animated" style="width:{{$persen_belum_pinjam}}%; height:8px;" role="progressbar">
											<span class="sr-only">{{$persen_belum_pinjam}} % Complete</span>
										</div>
									</div>	
									<span class="pull-right ml-auto col-1 col-xxl-2 px-0 text-right">{{$persen_belum_pinjam}}</span>
								</div>
								@php
								if(intval($total_peminjaman) == 0){ 
									$persen_sedang_pinjam = 0; 
									}
								else {
									$persen_sedang_pinjam = intval(($sedang_pinjam/$total_peminjaman)*100);
								}
								@endphp
								<div class="d-flex align-items-center  mb-3">
									<p class="mb-0 fs-14 mr-2 col-4 col-xxl-5 px-0">Sedang Pinjam ({{$persen_sedang_pinjam}}%)</p>
									<div class="progress mb-0" style="height:8px; width:100%;">
										<div class="progress-bar bg-success progress-animated" style="width:{{$persen_sedang_pinjam}}%; height:8px;" role="progressbar">
											<span class="sr-only">{{$persen_sedang_pinjam}}% Complete</span>
										</div>
									</div>
									<span class="pull-right ml-auto col-1 col-xxl-2 px-0 text-right">{{$persen_sedang_pinjam}}</span>
								</div>
								@php
								if(intval($total_peminjaman) == 0){ 
									$persen_dikembalikan = 0;
								}
								else{
									$persen_dikembalikan = intval(($dikembalikan/$total_peminjaman)*100);
								}
								@endphp
								<div class="d-flex align-items-center">
									<p class="mb-0 fs-14 mr-2 col-4 col-xxl-5 px-0">Sudah Dikembalikan ({{$persen_dikembalikan}}%)</p>
									<div class="progress mb-0" style="height:8px; width:100%;">
										<div class="progress-bar bg-dark progress-animated" style="width:{{$persen_dikembalikan}}%; height:8px;" role="progressbar">
											<span class="sr-only">{{$persen_dikembalikan}}% Complete</span>
										</div>
									</div>
									<span class="pull-right ml-auto col-1 col-xxl-2 px-0 text-right">{{$persen_dikembalikan}}</span>
								</div>
							</div>	
						</div>	
					</div>
				</div>
			</div>
		</div>
		<div class="col-12" data-aos="fade-down">
			<div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-intro-title">Jadwal Praktikum</h4>
                    <div class="">
                        <div id="external-events" class="my-3">
                            <div class="external-event" data-class="bg-primary"><i class="fa fa-move"></i>X MIPA</div>
                            <div class="external-event" data-class="bg-success"><i class="fa fa-move"></i>XI MIPA
                            </div>
                            <div class="external-event" data-class="bg-warning"><i class="fa fa-move"></i>XII MIPA</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div id="calendar" class="app-fullcalendar"></div>
                </div>
            </div>
        </div>
			</div>
    </div>
		<div class="col-6" data-aos="fade-down">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<h3 class="text-black font-w600 mb-4">Daftar Praktikum Akan Datang</h3>
					<div class="row justify-content-center">
						@foreach($praktikum_menunggu as $p)
						<div class="col-12">
							<h5 class="mb-0 text-black">
								<span class="ml-0">{{ $p->praktikum->NAMA_PRAKTIKUM }}</span>
							</h5>
							<p class="mb-0">{{ $p->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</p>
							<small>{{ $p->TANGGAL_PEMINJAMAN }} {{ $p->JAM_MULAI }} - {{ $p->JAM_SELESAI }}</small>
							<hr>
						</div>
						@endforeach
						@if($praktikum_menunggu->isEmpty())
						<div class="col-12 text-center my-5">
							Tidak ada praktikum.
						</div>
						@else
						<div class="col-12">
							<a href="{{ url('guru/praktikum') }}">
								<button class="btn btn-outline-success">Lihat Lainnya<i class="fa fa-arrow-right ml-2"></i></button>
							</a>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-6" data-aos="fade-down">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<h3 class="text-black font-w600 mb-4">Daftar Praktikum Selesai</h3>
					<div class="row justify-content-center">
						@foreach($praktikum_selesai as $p)
						<div class="col-12">
							<h5 class="mb-0 text-black">
								<span class="ml-0">{{ $p->praktikum->NAMA_PRAKTIKUM }}</span>
							</h5>
							<p class="mb-0">{{ $p->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</p>
							<small>{{ $p->TANGGAL_PEMINJAMAN }} {{ $p->JAM_MULAI }} - {{ $p->JAM_SELESAI }}</small>
							<hr>
						</div>
						@endforeach
						@if($praktikum_selesai->isEmpty())
						<div class="col-12 text-center my-5">
							Tidak ada praktikum.
						</div>
						@else
						<div class="col-12">
							<a href="{{ url('guru/praktikum') }}">
								<button class="btn btn-outline-success">Lihat Lainnya<i class="fa fa-arrow-right ml-2"></i></button>
							</a>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@foreach($praktikum as $p)
<div class="modal fade" id="modal-peminjaman-{{ $p->ID_PEMINJAMAN }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Peminjaman #{{ $p->ID_PEMINJAMAN }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">Nama Prakt.</div>
                    <div class="col-8">{{ $p->praktikum->NAMA_PRAKTIKUM }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Jadwal Prakt.</div>
                    <div class="col-8">{{ $p->TANGGAL_PEMINJAMAN }} {{$p->JAM_MULAI}} - {{ $p->JAM_SELESAI }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Kelas</div>
                    <div class="col-8">{{ $p->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Guru</div>
                    <div class="col-8">{{ $p->praktikum->kelas->guru->NAMA_LENGKAP }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('tambahan-script')
@if(!empty(config('dz.public.pagelevel.js.app_calender')))
	@foreach(config('dz.public.pagelevel.js.app_calender') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
		@endforeach
@endif
<script>
	var series_1 = Number("{{$persen_belum_pinjam}}");
	var series_2 = Number("{{$persen_sedang_pinjam}}");
	var series_3 = Number("{{$persen_dikembalikan}}");
	var donutChart = function(){
		var options = {
			series: [series_1,series_2,series_3],
			labels: ['Belum Pinjam', 'Sedang Pinjam', 'Sudah Dikembalikan'],
			colors:['#ff5c5a', '#2bc156', '#404a56'],
			chart: {
				width: 140,
				height: 140,
				type: 'donut',
				sparkline: {
					enabled: true,
				},
			},
			plotOptions: {
				pie: {
					donut: {
						size: '50%'
						
					}
				}
			},
			dataLabels: {
				enabled: false
			},
			responsive: [{
				breakpoint: 1300,
				options: {
					chart: {
						width: 120,
						height: 120
					},
				}
			}],
			legend: {
				show: false
			}
		};
		var chart = new ApexCharts(document.querySelector("#chart-donut"), options);
		chart.render();
	}
	donutChart();
	var a;
	var url = "{{ url('pengelola/datapraktikum') }}";

	$.get(url,function(result){
			a = result;
			var calendar = $("#calendar").fullCalendar({
					slotDuration: "00:15:00",
					minTime: "06:00:00",
					maxTime: "19:00:00",
					defaultView: "month",
					header: {
							left: "prev,next today",
							center: "title",
							right: "month,agendaWeek,agendaDay"
					},
					height: $(window).height() - 100,
					events: a,
					editable: false,
					droppable: false,
					eventLimit: false,
					selectable: false,
					eventClick: function(calEvent, jsEvent, view) {
							$("#modal-peminjaman-"+calEvent.id_peminjaman).modal('toggle');
					}
			});
	});
</script>
@endsection