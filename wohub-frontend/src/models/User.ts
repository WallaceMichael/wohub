export class User {
    id: number;
    nome: string;
    email: string;
    senha: string;
    data_criacao: string;
    tipo_usuario: string;
    foto: string;
    cargo: string;

    constructor(data: Partial<User>) {
        this.id = data.id ?? 0;
        this.nome = data.nome ?? '';
        this.email = data.email ?? '';
        this.senha = data.senha ?? '';
        this.data_criacao = data.data_criacao ?? '';
        this.tipo_usuario = data.tipo_usuario ?? '';
        this.foto = data.foto ?? '';
        this.cargo = data.cargo ?? '';
    }

    // Example method
    getDisplayName(): string {
        return `${this.nome} (${this.tipo_usuario})`;
    }

    isCreatorType(): boolean {
        return this.tipo_usuario === "2" ? true : false;
    }

    static getUser() {
        const user = JSON.parse(localStorage.getItem("user") ?? "null");
        return user ? new User(user) : null;
    }
}