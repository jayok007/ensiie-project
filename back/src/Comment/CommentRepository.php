<?php
namespace Comment;

class CommentRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function fetchByIdBar($idBar)
    {
        $request = $this->connection->prepare('SELECT idBar,idUser,content,dateCom FROM "comment" WHERE idBar = :id');
        $request->setFetchMode(\PDO::FETCH_CLASS, Comment::class);
        $request->bindParam(':id', $idBar, \PDO::PARAM_INT);

        if (!$request->execute()) return null;

        $comments = $request->fetchAll(\PDO::FETCH_CLASS);
        if (!$comments) return null;
        return $comments;
    }

    public function fetchAll()
    {
        $stmt = $this->connection->query('SELECT id,idBar,idUser,content,dateCom FROM comment');
        if (!$stmt) {
            return false;
        }
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Comment::class);
    }
}
