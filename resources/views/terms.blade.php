@extends('layout.layout')
@section('title', 'Tearms - ')
@section('main')

<div class="row">
    <div class="col-3">
        @include('shared.leftSideMenu')
    </div>
    <div class="col-6">
        <h1>Terms</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut, quod similique voluptate possimus rem
            inventore
            doloremque nisi necessitatibus qui, eaque, odit cupiditate tempore minus. Pariatur provident fuga laudantium
            consequuntur suscipit?</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero rem consectetur possimus sapiente esse soluta
            quod
            optio, dolorem repudiandae necessitatibus, qui atque inventore. Natus iste nemo at nihil ea mollitia
            sapiente
            unde
            dolore facere optio suscipit, recusandae cum odio et minus voluptate, dolorum asperiores, autem veritatis!
            Necessitatibus amet consectetur sit natus at omnis debitis illo. Eum, tempore optio, consequuntur quibusdam
            quis
            error omnis modi hic iure cumque quia vero, natus pariatur ducimus doloribus? Repellat, minima consequuntur
            fugiat
            cum facere maiores maxime at nobis, odio dolorum dolorem distinctio! Ipsa eveniet velit dolorum voluptas
            ratione
            veritatis autem aut sit odio optio libero, perferendis dolores ut dolor consequatur quia totam sed debitis
            in
            impedit. Recusandae officiis omnis eos quos culpa voluptate nemo commodi distinctio dolores quis veritatis
            aspernatur, alias id tenetur, architecto ad unde exercitationem consectetur. Ipsa aliquam excepturi minima
            natus
            incidunt non ipsum enim repellat, repellendus, culpa et temporibus provident molestias explicabo nobis ex
            officia
            illo ipsam architecto quibusdam inventore! Dolore neque dolorum quasi officiis esse earum alias iste id
            dolorem,
            quis ut eligendi repudiandae! Quos dolores similique cumque beatae ab omnis culpa eius hic, dolor expedita a
            molestias animi eligendi debitis aut officiis obcaecati provident modi repellat laudantium ex deleniti
            sapiente.
        </p>
    </div>
    <div class="col-3">
        @include('shared.searchBar')
        <div class="mt-3"></div>
        @include('shared.followBox')
    </div>
</div>
@endsection