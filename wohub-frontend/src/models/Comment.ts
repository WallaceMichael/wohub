import {User} from "@/models/User";

export class Comment {
    id: number;
    usuario_id: number;
    data_comentario: string;
    texto: string;
    artigos_id: number;
    usuario: User;

    constructor(data: Partial<Comment>) {
        this.id = data.id ?? 0;
        this.usuario_id = data.usuario_id ?? 0;
        this.data_comentario = data.data_comentario ?? '';
        this.texto = data.texto ?? '';
        this.artigos_id = data.artigos_id ?? 0;
        this.usuario = new User(data.usuario ?? {});
    }
}