    @extends('principal')
        @section('contenido')

        @if(Auth::check())
                @if (Auth::user()->idrol == 1)


                <template v-if="menu==0">
                <ganados></ganados>
                </template>

                <template v-if="menu==2">
                <rfid-read></rfid-read>
                </template>

                <template v-if="menu==3">
                    <lista></lista>
                </template>

                <template v-if="menu==4">
                    <user></user>
                </template>
                <template v-if="menu==5">
                    <registrar-ganado></registrar-ganado>
                </template>

                @elseif (Auth::user()->idrol == 2)
                    <template v-if="menu==0">
                        <registrar-ganado></registrar-ganado>
                    </template>
                    <template v-if="menu==1">
                        <rfid-read></rfid-read>
                        </template>

                @elseif (Auth::user()->idrol == 3)

                @else

                @endif

        @endif


        @endsection

