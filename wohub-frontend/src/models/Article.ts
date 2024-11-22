import {User} from "@/models/User";

export class Article {
    id: number;
    titulo: string;
    descricao: string;
    categoria: string;
    foto: string;
    usuarios_id: number;
    usuario: User;
    comentarios: Comment[];

    constructor(data: Partial<Article>) {
        this.id = data.id ?? 0;
        this.titulo = data.titulo ?? '';
        this.descricao = data.descricao ?? '';
        this.categoria = data.categoria ?? '';
        this.foto = data.foto ?? '';
        this.usuarios_id = data.usuarios_id ?? 0;
        this.usuario = new User(data.usuario ?? {});
        this.comentarios = (data.comentarios ?? []).map((comment: any) => new Comment(comment));
    }

    // Example method
    getCommentCount(): number {
        return this.comentarios.length;
    }
}