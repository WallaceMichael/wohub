import {User} from "@/models/User";

export class Course {
    id: number;
    titulo: string;
    descricao: string;
    categoria: string;
    link: string;
    foto: string;
    usuario: User;

    constructor(data: Partial<Course>) {
        this.id = data.id ?? 0;
        this.titulo = data.titulo ?? '';
        this.descricao = data.descricao ?? '';
        this.categoria = data.categoria ?? '';
        this.link = data.link ?? '';
        this.foto = data.foto ?? '';
        this.usuario = new User(data.usuario ?? {});
    }

    // Example method
    getSummary(): string {
        return `${this.titulo} - ${this.categoria}: ${this.descricao}`;
    }
}
