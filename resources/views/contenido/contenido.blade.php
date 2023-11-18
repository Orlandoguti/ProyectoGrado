    @extends('principal')
        @section('contenido')

        @if(Auth::check())
                @if (Auth::user()->idrol == 1)

                <template v-if="menu==0">
                    <noticias></noticias>
                </template>

                <template v-if="menu==1">
                <ganados></ganados>
                </template>
                <template v-if="menu==2">
                    <registrar-ganado></registrar-ganado>
                </template>

                <template v-if="menu==3">
                <rfid-read></rfid-read>
                </template>

                <template v-if="menu==4">
                    <rfid-procesofinal></rfid-procesofinal>
                </template>

                <template v-if="menu==5">
                    <lista></lista>
                </template>

                <template v-if="menu==6">
                    <user></user>
                </template>

                <template v-if="menu==7">
                    <corrales></corrales>
                </template>

                <template v-if="menu==8">
                    <detalle-lista></detalle-lista>
                </template>
                <template v-if="menu==9">
                    <ingreso-egreso></ingreso-egreso>
                </template>
                 <template v-if="menu==10">
                    <grupos></grupos>
                </template>
                <template v-if="menu==11">
                    <clasegresos></clasegresos>
                </template>

                @elseif (Auth::user()->idrol == 2)

                <template v-if="menu==0">
                    <noticias-afiliado></noticias-afiliado>
                </template>

                <template v-if="menu==1">
                <ganados></ganados>
                </template>

                <template v-if="menu==2">
                    <registrar-ganado></registrar-ganado>
                </template>

                <template v-if="menu==3">
                <rfid-read></rfid-read>
                </template>

                <template v-if="menu==4">
                    <rfid-procesofinal></rfid-procesofinal>
                </template>

                <template v-if="menu==5">
                    <lista></lista>
                </template>

                <template v-if="menu==6">
                    <noticias></noticias>
                </template>

                <template v-if="menu==7">
                    <corrales></corrales>
                </template>
                <template v-if="menu==8">
                    <detalle-lista></detalle-lista>
                </template>


                @elseif (Auth::user()->idrol == 3)
                <template v-if="menu==0">
                    <noticias></noticias>
                </template>
                <template v-if="menu==1">
                    <afiliado-ganado></afiliado-ganado>
                </template>
                <template v-if="menu==2">
                    <lista-afiliado-ganado></lista-afiliado-ganado>
                </template>

                @else

                @endif

        @endif


        @endsection

