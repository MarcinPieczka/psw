from rest_framework import serializers


class CommentSerializer(serializers.Serializer):
    page_id = serializers.IntegerField
    user = serializers.CharField
    created = serializers.DateTimeField
    text = serializers.CharField
